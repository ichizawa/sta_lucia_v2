<?php

namespace App\Events;

use App\Models\TenantDocuments;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Owner;

class TenantEvent implements ShouldBroadcastNow
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
        $owners = Owner::with([
                'companies',
                'representatives',
                'tenantDocuments.documents',
            ])
            ->get()
            // Remove any owner missing a company, representative, or tenantDocument
            ->filter(function($owner) {
                return $owner->companies->isNotEmpty()
                    && $owner->representatives->isNotEmpty()
                    && $owner->tenantDocument !== null;
            })
            ->map(function($owner) {
                $company        = $owner->companies->first();
                $representative = $owner->representatives->first();
                $docRelation    = $owner->tenantDocument;

                return [
                    'owner_id'        => $owner->id,
                    'company_name'    => $company->company_name        ?? '',
                    'store_name'      => $company->store_name          ?? '',
                    'company_address' => $company->company_address     ?? '',
                    'tenant_type'     => $company->tenant_type         ?? '',

                    'rep_fname'       => $representative->rep_fname    ?? '',
                    'rep_lname'       => $representative->rep_lname    ?? '',
                    'rep_address'     => $representative->rep_address  ?? '',
                    'rep_email'       => $representative->rep_email    ?? '',
                    'rep_status'      => isset($representative->status)
                                           ? (int) $representative->status
                                           : 0,

                    'doc_status'      => isset($docRelation->status)
                                           ? (int) $docRelation->status
                                           : 0,
                ];
            })
            ->values()
            ->toArray();

        return ['owners' => $owners];
    }
}
