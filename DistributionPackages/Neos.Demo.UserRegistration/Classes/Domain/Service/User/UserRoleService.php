<?php
namespace Neos\Demo\UserRegistration\Domain\Service\User;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Security\Account;
use Neos\Flow\Security\Policy\PolicyService;
use Neos\Neos\Service\UserService;

/**
 *
 * @Flow\Scope("singleton")
 */
class UserRoleService {

    /**
     * @Flow\Inject
     * @var UserService
     */
    protected $userService;

    /**
     * @Flow\Inject
     * @var PolicyService
     */
    protected $policyService;

    /**
     * checks if editor has RestrictedEditorRole
     */
    public function isRestrictedEditor(): bool {
        $restrictedEditorRole = $this->policyService->getRole('Neos.Neos:RestrictedEditor');
        $userAccounts = $this->userService->getBackendUser()->getAccounts();
        /* @var Account */
        foreach ($userAccounts as $account) {
            if ($account->hasRole($restrictedEditorRole)) {
                return true;
            }
        }
        return false;
    }
}
