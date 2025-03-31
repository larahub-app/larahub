<?php

namespace App\Livewire\Packages;

use App\Models\Package;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public int $perPage = 5;

    public function getPackagesProperty()
    {
        $query = Package::latest()->processed()->with(['user']);

        // if ($this->stack) {
        //     $query->where('stack', $this->stack);
        // }

        // if ($this->categories) {
        //     $query->where('categories', $this->categories);
        // }

        return $query->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.packages.index');
    }
}
