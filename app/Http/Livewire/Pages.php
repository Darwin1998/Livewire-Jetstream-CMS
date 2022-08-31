<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Illuminate\Validation\Rule;

use Livewire\WithPagination;

use Livewire\Component;

class Pages extends Component
{

    use WithPagination;

    public $slug;
    public $title;
    public $content;
    public $modelId;

    public $modalFormVisible = false;

    public function  rules()
    {

        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages','slug')],
            'content' => 'required',
        ];
    }

    public function create()
    {


        $this->validate();
        Page::create($this->modelData());
        $this->modalFormVisible = false;

        $this->resetVars();
    }

    public function updatedTitle($value)
    {
        $this->slug = strtolower(str_replace(' ', '-',$value));

    }

    public function modelData()
    {

        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => strip_tags($this->content),

        ];
    }


    public function resetVars()
    {

        $this->modelId = null;
        $this->title = null;
        $this->slug = null;
        $this->content = null;

    }
    /**
     * the livewire render function
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pages', [
            'data' => $this->read(),
        ]);
    }

    public function read()
    {
        return Page::paginate(10);
    }

    public function mount()
    {
        $this->resetPage();
    }
    /**
     * shows the form modal
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->resetValidation();
        $this->resetVars();
        $this->modalFormVisible = true;
    }

    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->resetVars();
        $this->modelId = $id;
        $this->modalFormVisible = true;

        $this->loadModel();



    }

    public function update()
    {
        $this->validate();
        Page::find($this->modelId)->update($this->modelData());

        $this->modalFormVisible = false;
    }

    public function loadModel()
    {
        $data = Page::find($this->modelId);

        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;
    }


}
