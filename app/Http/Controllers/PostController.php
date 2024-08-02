<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
        return view('post.index', compact('post'));
    }

    public function create()
    {
        return view('post.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'date' => 'required',
            'username' => 'required',
        ]);

        $existingPost = Post::where('title', $request->title)->exists();
        if ($existingPost) {
            return redirect()->back()->withInput()->withErrors(['title' => 'Post sudah terdaftar.']);
        }

        Post::create($request->all());

        return redirect()->route('post.index')->with('success', 'Post berhasil ditambahkan');
    }


    public function edit($id)
    {
        $post = Post::find($id);
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required|boolean',
            'date' => 'required',
            'username' => 'required',
        ]);
        $post = Post::find($id);

        $existingPost = Post::where('title', $request->title)
            ->exists();
        if ($existingPost) {
            return redirect()->back()->withInput()->withErrors(['title' => 'Post sudah terdaftar.']);
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'date' => $request->date,
            'username' => $request->username,
        ]);

        return redirect()->route('post.index')->with('success', 'Post berhasil diubah');
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('post.index')->with('success', 'Post berhasil dihapus');
    }
}
