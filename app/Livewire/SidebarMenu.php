<?php

namespace App\Livewire;

use App\Traits\SidebarTrait;
use Livewire\Component;

class SidebarMenu extends Component
{
    use SidebarTrait;

    public function render()
    {
        return view('livewire.sidebar-menu', ['initDropedItems' => $this->getItemsByUrlPrefix(), 'html' => $this->getSidebar()]);
    }
}
