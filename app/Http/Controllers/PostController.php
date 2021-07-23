<?php

namespace App\Http\Controllers;

use App\DataTables\PostDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\PostRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Category;
use App\Models\Post;


class PostController extends AppBaseController
{
    /** @var  PostRepository */
    private $postRepository;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepository = $postRepo;
    }

    /**
     * Display a listing of the Post.
     *
     * @param PostDataTable $postDataTable
     * @return Response
     */
    public function index(PostDataTable $postDataTable)
    {
        return $postDataTable->render('posts.index');
    }

    /**
     * Show the form for creating a new Post.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id');
        return view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created Post in storage.
     *
     * @param CreatePostRequest $request
     *
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->all();

        $photo = $request->file('photo');
        $photo_name = uniqid() . "_" . $photo->getClientOriginalName();
        $photo->move(public_path() . "/upload/post/", $photo_name);
        $input['photo'] = $photo_name;

        $post = $this->postRepository->create($input);

        Flash::success('Post saved successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified Post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepository->find($id);

        $posts = Post::all();

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('posts.show',compact('posts'))->with('post', $post);
    }

    /**
     * Show the form for editing the specified Post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->find($id);

        $categories = Category::pluck('name', 'id');

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('posts.edit',compact('categories'))->with('post', $post);
    }

    /**
     * Update the specified Post in storage.
     *
     * @param  int              $id
     * @param UpdatePostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostRequest $request)
    {
        $post = $this->postRepository->find($id);

        // return $photo = $request->file('photo');
        if ($request->hasFile('photo')) {

            $photo = $request->file('photo');
            $photo_name = uniqid() . "_" . $photo->getClientOriginalName();
            $photo->move(public_path() . "/upload/post/", $photo_name);

            $post = Post::findOrFail($id);
            $image_path = public_path() . "/upload/post/" . $post->photo;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            Post::findOrFail($id)->update([
                'photo' => $photo_name,
                'cat_id' => $request->get('cat_id'),
                'title' => $request->get('title'),
                'content' => $request->get('content')
            ]);
        } else {
            Post::findOrFail($id)->update([
                'cat_id' => $request->get('cat_id'),
                'title' => $request->get('title'),
                'content' => $request->get('content')
            ]);
        }

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        // $post = $this->postRepository->update($request->all(), $id);

        Flash::success('Post updated successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified Post from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        $this->postRepository->delete($id);

        Flash::success('Post deleted successfully.');

        return redirect(route('posts.index'));
    }
}
