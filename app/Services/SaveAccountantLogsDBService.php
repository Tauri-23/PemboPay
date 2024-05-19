<?php
namespace App\Services;

use App\Contracts\IGenerateIdService;
use App\Contracts\ISaveAccountantLogsDBService;
use App\Models\AccountantLogs;

class SaveAccountantLogsDBService implements ISaveAccountantLogsDBService {
    protected $generateId;

    public function __construct(IGenerateIdService $generateId) {
        $this->generateId = $generateId;
    }

    public function saveLog($logTitle) {
        $log = new AccountantLogs;
        $log->id = $this->generateId->generate(AccountantLogs::class);
        $log->accountant = session('logged_treasury');
        $log->title = $logTitle;
        $log->save();
    }
}