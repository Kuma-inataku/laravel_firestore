<?php

namespace App\Http\Controllers;

use App\Facades\FirestoreApiFacade;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Http\Client\Request;

class FirestoreController extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = app('firebase.firestore')->database();
    }

    public function load() {
        $collection = $this->db->collection('talk_api');
        $documents = $collection->documents();

        $apiData = [];
        $ids = [];
        foreach ($documents as $document) {
            $apiData[] = $document->data();
            $ids[] = $document->id();
        }
        return response()->json([
            'apiData' => $apiData,
            'ids' => $ids
        ]);
    }

    public function store() {
        $collection = $this->db->collection('talk_api');
        $storeData = $collection->add(request()->all());

        return response()->json([
            'storeData' => $storeData->snapshot()->data(),
        ]);
    }

    public function update() {
        $collection = $this->db->collection('talk_api');
        $document = $collection->document(request()->updateId);

        $updateData = $document->set([
            'talk' => request()->talk,
            'type' => request()->type,
        ]);

        return response()->json([
            'updateData' => $updateData,
        ]);
    }
}
