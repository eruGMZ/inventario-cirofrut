<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait SidebarTrait
{
    public function baseConfig(): array
    {
        $configs[] = config('sidebar_menu.inventario');
        return $configs;
    }

    public function getSidebar(): string
    {
        $aux = '<ul class="space-y-2 font-medium">';
        
        $aux .= $this->buildSidebarHTML($this->baseConfig());

        return $aux . '</ul>';
    }

    protected function buildSidebarHTML(array $items): string
    {
        $html = '';

        foreach ($items as $item) {
            $icon = $item['icon'] ?? '';
            $name = $item['name'] ?? '';
            $hasChildrens = isset($item['childrens']) && is_array($item['childrens']);
            $safeDropdownId = $item['id_drop'] ?? 'dropdown-' . Str::slug($name);

            if (isset($item['permission']) && !Auth::user()->can($item['permission'])) continue;

            $html .= "<li>";

            if ($hasChildrens) {
                $html .=    "<button type=\"button\"
                                class=\"w-full flex items-center p-2 text-base font-normal transition duration-75 group hover:bg-gray-100 dark:hover:bg-gray-700\"
                                @click=\"toggle('{$safeDropdownId}')\">
                                {$icon}
                                <span class=\"flex-1 ms-3 text-left rtl:text-right whitespace-nowrap text-white\">{$name}</span>
                                <svg class=\"w-4 h-4 text-white ml-auto\" fill=\"currentColor\" viewBox=\"0 0 20 20\"><path fill-rule=\"evenodd\" d=\"M5.23 7.21a.75.75 0 011.06.02L10 11.292l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.66a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z\" clip-rule=\"evenodd\"></path></svg>
                            </button>";
                $html .= "<ul id=\"{$safeDropdownId}\" style=\"padding-left: 15px;\" class=\"py-2 space-y-2\" x-show=\"isOpen('{$safeDropdownId}')\" x-cloak>";
                $html .= $this->buildSidebarHTML($item['childrens']);
                $html .= "</ul>";
            } else {
                $route = isset($item['link']) ? route($item['link']) : '#';
                $html .= "<a href=\"{$route}\" style=\"padding-left: 10px;\" class=\"flex items-center w-full p-2 text-base font-normal text-white transition duration-75 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700\">";
                $html .= "{$icon}<span>{$name}</span></a>";
            }

            $html .= "</li>";
        }

        return $html;
    }

    public function getItemsByUrlPrefix(): array
    {
        $currentUrl = url()->current();
        $openDropdowns = [];

        foreach ($this->baseConfig() as $item) {
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
