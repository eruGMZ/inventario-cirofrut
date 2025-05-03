<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait SidebarTrait
{
    public function getSidebarConfig(): array
    {
        $configs = [];

        foreach (File::files(config_path('sidebar_menu')) as $file) {
            $configs[] = require $file->getPathname();
        }

        return $configs;
    }

    public function getHTMLSidebar(): string
    {
        return $this->buildSidebarHTML($this->getSidebarConfig());
    }

    protected function buildSidebarHTML(array $items, bool $isChild = false): string
    {
        $html = '';

        foreach ($items as $item) {
            if (isset($item['permission']) && !auth()->user()?->can($item['permission'])) {
                continue;
            }

            $icon = $item['icon'] ?? '';
            $name = $item['name'] ?? '';
            $hasChildren = isset($item['childrens']) && is_array($item['childrens']);
            $dropdownId = $item['id_drop'] ?? 'dropdown-' . \Str::slug($name);

            if ($hasChildren) {
                $html .= '<div class="space-y-1">';
                $html .= '<button type="button" class="w-full flex items-center p-2 text-base font-normal transition duration-75 group hover:bg-gray-100 dark:hover:bg-gray-700" data-collapse-toggle="' . $dropdownId . '">';
                $html .= $icon . '<span class="flex-1 ml-3 text-left whitespace-nowrap">' . $name . '</span>';
                $html .= '<svg class="w-4 h-4 ml-auto" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.292l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.66a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd"></path></svg>';
                $html .= '</button>';
                $html .= '<ul id="' . $dropdownId . '" class="hidden py-2 space-y-2">';
                $html .= $this->buildSidebarHTML($item['childrens'], true);
                $html .= '</ul>';
                $html .= '</div>';
            } else {
                $route = $item['link'] ?? '#';
                $url = route($route, [], false);
                $html .= '<li>';
                $html .= '<a href="' . $url . '" class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">';
                $html .= $icon . '<span class="ml-3">' . $name . '</span></a>';
                $html .= '</li>';
            }
        }

        return $html;
    }

    public function getItemsByUrlPrefix(): array
    {
        $currentUrl = url()->current();
        $openDropdowns = [];

        foreach ($this->getSidebarConfig() as $item) {
            $this->collectOpenDropdowns($item, $currentUrl, $openDropdowns);
        }

        return $openDropdowns;
    }

    protected function collectOpenDropdowns(array $item, string $url, array &$openDropdowns): bool
    {
        $matched = false;

        if (!empty($item['prefix_route'])) {
            $matched = collect($item['prefix_route'])->every(fn($segment) => str_contains($url, $segment));
        }

        if (!empty($item['childrens'])) {
            foreach ($item['childrens'] as $child) {
                if ($this->collectOpenDropdowns($child, $url, $openDropdowns)) {
                    $matched = true;
                }
            }
        }

        if ($matched && isset($item['id_drop'])) {
            $openDropdowns[] = $item['id_drop'];
        }

        return $matched;
    }
}
