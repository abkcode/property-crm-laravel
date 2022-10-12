<?php

namespace App\Http\Controllers;

use App\Jobs\FetchProperty;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Property::paginate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch()
    {
        FetchProperty::dispatch();

        return [
            'message' => 'properties will be fetched in few minutes'
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'property_type_id' => ['required', 'max:255'],






        //     'name' => ['required', 'max:255'],
        //     'git_clone_url' => ['required', 'max:255'],
        //     'git_main_branch_name' => ['required', 'max:255'],
        //     'php_version' => ['required', Rule::in(Project::SUPPORTED_PHP_VERSIONS)],
        //     'target_php_version' => [Rule::in(Project::SUPPORTED_PHP_VERSIONS)],
        // ]);

        // OpenSSH::setComment('pureloop-generated-key');
        // $key = RSA::createKey();
        // $privateKeyStr = $key->toString('OpenSSH');
        // $publicKeyStr = $key->getPublicKey()
        //     ->toString('OpenSSH')
        // ;

        // $project = Project::create([
        //     'user_id' => Auth::user()->id,
        //     'name' => $request->name,
        //     'git_clone_url' => $request->git_clone_url,
        //     'git_main_branch_name' => $request->git_main_branch_name,
        //     'php_version' => $request->php_version,
        //     'target_php_version' => $request->target_php_version,
        //     'ssh_public_key' => $publicKeyStr,
        //     'ssh_private_key' => Crypt::encryptString($privateKeyStr),
        // ]);

        // return [
        //     'message' => 'Project created succesfully',
        //     'project' => $project,
        // ];
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(int $id)
    // {
    //     $project = Project::where('id', $id)->where('user_id', Auth::user()->id)->first();
    //     if ($project === null) {
    //         return response()->json([
    //             'message' => 'Project not found',
    //         ], 404);
    //     }

    //     // dd(Crypt::decryptString($project->git_password));

    //     return [
    //         'project' => $project,
    //     ];
    // }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        // $request->validate([
        //     'name' => ['max:255'],
        //     // 'git_clone_url' => ['url', 'max:255'],
        //     'git_clone_url' => ['max:255'],
        //     'git_main_branch_name' => ['max:255'],
        //     'php_version' => [Rule::in(Project::SUPPORTED_PHP_VERSIONS)],
        //     'target_php_version' => [Rule::in(Project::SUPPORTED_PHP_VERSIONS)],
        // ]);
        // $project = Project::where('id', $id)->where('user_id', Auth::user()->id)->first();
        // if ($project === null) {
        //     return response()->json([
        //         'message' => 'Project not found',
        //     ], 404);
        // }
        // if ($request->get('name')) {
        //     $project->name = $request->get('name');
        // }
        // if ($request->get('git_clone_url')) {
        //     $project->git_clone_url = $request->get('git_clone_url');
        // }
        // if ($request->get('git_main_branch_name')) {
        //     $project->git_main_branch_name = $request->get('git_main_branch_name');
        // }
        // if ($request->get('php_version')) {
        //     $project->php_version = $request->get('php_version');
        // }
        // if ($request->get('target_php_version')) {
        //     $project->target_php_version = $request->get('target_php_version');
        // }
        // if (!$project->save()) {
        //     return response()->json([
        //         'message' => 'Failed to update the project',
        //     ], 500);
        // }

        // return [
        //     'message' => 'Project updated succesfully',
        //     'project' => $project,
        // ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        // $project = Project::where('id', $id)->where('user_id', Auth::user()->id)->first();
        // if ($project === null) {
        //     return response()->json([
        //         'message' => 'Project not found',
        //     ], 404);
        // }
        // if (!$project->delete()) {
        //     return response()->json([
        //         'message' => 'Failed to delete the project',
        //     ], 500);
        // }

        // return [
        //     'message' => 'Project deleted succesfully',
        // ];
    }
}
