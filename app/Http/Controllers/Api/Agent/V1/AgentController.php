<?php

namespace App\Http\Controllers\Api\Agent\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Agent\V1\SaveAgentRequest;
use App\Http\Resources\AgentResource;
use App\Models\Agent;
use App\Services\Agent\V1\AgentService;

class AgentController extends Controller
{
    public function __construct(public AgentService $agentService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->ok(AgentResource::collection($this->agentService->getList()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveAgentRequest $request)
    {
        return $this->created(new AgentResource($this->agentService->store($request->validated())));
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        return $this->ok(new AgentResource($agent));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveAgentRequest $request, Agent $agent)
    {
        return $this->ok(new AgentResource($this->agentService->update($agent, $request->validated())));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        $this->agentService->delete($agent);

        return $this->ok();
    }
}
