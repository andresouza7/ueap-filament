<?php

namespace App\Observers;

use App\Models\Answer;
use App\Models\Evaluation;

class EvaluationObserver
{
    /**
     * Handle the Evaluation "created" event.
     */
    public function created(Evaluation $evaluation): void
    {
        // on create evaluation, create entries for que evalution items
        $dimensions = $evaluation->category->dimensions;

        foreach ($dimensions as $dimension) {
            foreach ($dimension->questions as $question) {
                Answer::firstOrCreate([
                    'evaluation_id' => $evaluation->id,
                    'question_id' => $question->id
                ]);
            }
        }
    }

    /**
     * Handle the Evaluation "updated" event.
     */
    public function updated(Evaluation $evaluation): void
    {
        //
    }

    /**
     * Handle the Evaluation "deleted" event.
     */
    public function deleted(Evaluation $evaluation): void
    {
        //
    }

    /**
     * Handle the Evaluation "restored" event.
     */
    public function restored(Evaluation $evaluation): void
    {
        //
    }

    /**
     * Handle the Evaluation "force deleted" event.
     */
    public function forceDeleted(Evaluation $evaluation): void
    {
        //
    }
}
