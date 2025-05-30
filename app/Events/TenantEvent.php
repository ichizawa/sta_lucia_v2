<?php

namespace App\Events;

use App\Models\TenantDocuments;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TenantEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The tenant document that was created/updated.
     *
     * @var \App\Models\TenantDocuments
     */
    public TenantDocuments $tenantDocument;

    /**
     * Create a new event instance.
     */
    public function __construct(TenantDocuments $tenantDocument)
    {
        $this->tenantDocument = $tenantDocument;
    }

    /**
     * Get the channels the event should broadcast on.
     */

    public function broadcastOn(): Channel
    {
        return new Channel('tenant.documents');
    }

    /**
     * The event’s name.
     */
    public function broadcastAs(): string
    {
        return 'tenant.document.changed';
    }

    /**
     * The data to broadcast.
     */
    public function broadcastWith(): array
    {
        return [
            'id'          => $this->tenantDocument->id,
            'owner_id'    => $this->tenantDocument->owner_id,
            'document_id' => $this->tenantDocument->document_id,
            'view'        => $this->tenantDocument->view,
            'status'      => $this->tenantDocument->status,
            // optionally include the related DocumentsTable record:
            'details'     => $this->tenantDocument->documents?->toArray(),
        ];
    }
}
