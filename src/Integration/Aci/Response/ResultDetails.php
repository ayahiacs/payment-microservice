<?php

namespace App\Integration\Aci\Response;

class ResultDetails
{
    function __construct(
        public string $ExtendedDescription,
        public string $clearingInstituteName,
        public string $ConnectorTxID1,
        public string $ConnectorTxID3,
        public string $ConnectorTxID2,
        public string $AcquirerResponse
    ) {}
}
