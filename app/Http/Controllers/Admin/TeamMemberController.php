<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('sort_order')->paginate(10);
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        $member = new TeamMember();
        return view('admin.team.edit', compact('member'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success', 'Yeni əməkdaş əlavə edildi.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', ['member' => $team]);
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $this->validated($request);
        $team->update($data);
        return redirect()->route('admin.team.index')->with('success', 'Əməkdaş yeniləndi.');
    }

    public function destroy(TeamMember $team)
    {
        $team->delete();
        return back()->with('success', 'Əməkdaş silindi.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'emoji'      => ['nullable', 'string', 'max:20'],
            'name'       => ['required', 'string', 'max:255'],
            'role'       => ['required', 'string', 'max:255'],
            'experience' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['integer'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $data['emoji']     = $data['emoji'] ?: '👨‍🔧';
        return $data;
    }
}
