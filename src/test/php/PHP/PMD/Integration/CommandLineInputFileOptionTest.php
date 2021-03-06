<?php
/**
 * This file is part of PHP_PMD.
 *
 * PHP Version 5
 *
 * Copyright (c) 2008-2012, Manuel Pichler <mapi@phpmd.org>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Manuel Pichler nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   PHP
 * @package    PHP_PMD
 * @subpackage Integration
 * @author     Manuel Pichler <mapi@phpmd.org>
 * @copyright  2008-2012 Manuel Pichler. All rights reserved.
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    SVN: $Id$
 * @link       http://phpmd.org
 * @since      1.1.0
 */

require_once dirname(__FILE__) . '/../AbstractTest.php';

require_once 'PHP/PMD/TextUI/Command.php';

/**
 * Integration tests for the command line option <em>--inputfile</em>.
 *
 * @category   PHP
 * @package    PHP_PMD
 * @subpackage Integration
 * @author     Manuel Pichler <mapi@phpmd.org>
 * @copyright  2008-2012 Manuel Pichler. All rights reserved.
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://phpmd.org
 * @since      1.1.0
 *
 * @group phpmd
 * @group phpmd::integration
 * @group integrationtest
 */
class PHP_PMD_Integration_CommandLineInputFileOptionTest
    extends PHP_PMD_AbstractTest
{
    /**
     * testReportContainsExpectedRuleViolationWarning
     *
     * @return void
     * @outputBuffering enabled
     */
    public function testReportContainsExpectedRuleViolationWarning()
    {
        self::assertContains(
            "Avoid unused local variables such as '\$foo'.",
            self::runCommandLine()
        );
    }

    /**
     * testReportNotContainsRuleViolationWarningForFileNotInList
     *
     * @return void
     * @outputBuffering enabled
     */
    public function testReportNotContainsRuleViolationWarningForFileNotInList()
    {
        self::assertNotContains(
            "Avoid unused local variables such as '\$bar'.",
            self::runCommandLine()
        );
    }

    /**
     * Runs the PHPMD command line interface and returns the report content.
     *
     * @return string
     */
    protected static function runCommandLine()
    {
        $inputfile  = self::createResourceUriForTest('inputfile.txt');
        $reportfile = self::createTempFileUri();

        self::changeWorkingDirectory(dirname($inputfile));
var_dump(getcwd());
        PHP_PMD_TextUI_Command::main(
            array(
                __FILE__,
                'text',
                'unusedcode',
                '--reportfile',
                $reportfile,
                '--inputfile',
                $inputfile
            )
        );
        return file_get_contents($reportfile);
    }
}
