<?php

namespace App\Http\Resources;

use App\Models\Application;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class HomePageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    private function applicant($applications){
        $id = [];
        foreach ($applications as $app){
            $id[] = $app->applicant_id;
        }
        return $id;
    }
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'salary' => $this->salary,
            'location' => $this->location,
            'country' => $this->country,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'company' => $this->company,
            'applicant_id' => $this->applicant($this->applications)
        ];
    }
}
