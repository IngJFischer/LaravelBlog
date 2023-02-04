<?php

namespace App\View\Components\Web\Blog\post;

use Illuminate\View\Component;

class Show extends Component
{
    public $post;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    public function changeTitle()
    {
        //dd($this->post->all());
        $this->post['title'] = "TituloNuevo";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.web.blog.post.Show');
    }
}
