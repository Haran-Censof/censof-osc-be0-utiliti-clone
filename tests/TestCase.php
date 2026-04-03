<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class TestCase extends BaseTestCase
{
    use DatabaseTransactions;

    /**
     * Using DatabaseTransactions instead of RefreshDatabase
     * This wraps each test in a database transaction that is rolled back after the test
     * Benefits:
     * - Faster test execution (no need to refresh database between tests)
     * - Database state preserved between test runs
     * - Each test still gets clean state via transaction rollback
     */
}
