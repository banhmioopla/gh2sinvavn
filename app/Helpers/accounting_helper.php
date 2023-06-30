<?php

if (! function_exists('income_fixed_rate_accounts')) {
    // get percentage factor accounts, data = [account_id_1, account_id_2, account_id_3,....]
    // work with income_rate_fixed()
    function income_fixed_rate_accounts():array{
        $config = get_config('income_rate_fixed_accounts_apply');

        return json_decode($config) ?? [];
    }
}

if (! function_exists('income_fixed_rate')) {
    // get percentage return 0.6 | 0.4
    function income_fixed_rate():float{
        return (float)get_config('income_rate_fixed') ?? 0;
    }
}

if (! function_exists('greater_threshold_contract_count')) {
    // get count contract return integer 5 6 4
    function greater_threshold_contract_count():int{
        return (float)get_config('income_rate_fixed') ?? 0;
    }
}

if (! function_exists('greater_threshold_contract_count_rate_apply')) {
    // get percentage return integer %
    function greater_threshold_contract_count_rate_apply():float{
        return (float)get_config('greater_threshold_contract_count_rate_apply') ?? 0;
    }
}