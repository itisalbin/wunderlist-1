<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TodoList;
use Auth;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Database\LazyLoadingViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;
use InvalidArgumentException;
use LogicException;

class NewTaskController extends Controller
{
    /** @return void  */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return View|Factory
     * @throws BindingResolutionException
     */
    public function show(): View|Factory
    {
        return view('newTask.show', [
            'lists' => Auth::user()->lists,
            'selectedList' => request()->query('list') ?? null
        ]);
    }

    /**
     * @return Redirector|RedirectResponse
     * @throws BindingResolutionException
     * @throws InvalidArgumentException
     * @throws InvalidCastException
     * @throws LazyLoadingViolationException
     * @throws LogicException
     */
    public function store(): Redirector|RedirectResponse
    {
        // https://laravel.com/docs/8.x/validation#specifying-a-custom-column-name
        $data = request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'deadline' => ['date', 'nullable'],
            'list' => [
                'required', 'string', 'max:5',
                Rule::exists('todo_lists', 'uuid')->where(function ($query) {
                    return $query->where('user_id', Auth::user()->id);
                })
            ]
        ]);

        Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'deadline' => $data['deadline'],
            'list_id' => TodoList::where('uuid', $data['list'])->first('id')['id']
        ]);

        return redirect(route('list.show', $data['list']));
    }
}
