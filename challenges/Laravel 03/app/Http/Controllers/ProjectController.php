<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', ['projects' => $projects]);
    }

    public function adminIndex()
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }
        $projects = Project::all();
        return view('admin.projects.index', ['projects' => $projects]);
    }

    public function create()
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        $validated = $request->validate([
            'name' => 'required',
            'subtitle' => 'required',
            'image' => 'required|url',
            'url' => 'required|url',
            'description' => 'required|max:200'
        ]);

        Project::create($validated);
        return redirect('/admin/projects')->with('success', 'Продуктот е успешно додаден!');
    }

    public function edit($id)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }
        
        session(['editing' => $id]);
        return redirect('/admin/projects');
    }

    public function update(Request $request, $id)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        $validated = $request->validate([
            'name' => 'required',
            'subtitle' => 'required',
            'image' => 'required|url',
            'url' => 'required|url',
            'description' => 'required|max:200'
        ]);

        $project = Project::find($id);
        $project->update($validated);
        return redirect('/admin/projects')->with('success', 'Продуктот е успешно изменет!');
    }

    public function destroy($id)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }
        
        Project::find($id)->delete();
        return redirect('/admin/projects')->with('success', 'Продуктот е успешно избришан!');
    }
}

?>