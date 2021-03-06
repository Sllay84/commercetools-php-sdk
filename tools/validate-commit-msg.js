#!/usr/bin/env node

/**
 The MIT License

 Copyright (c) 2010-2015 Google, Inc. http://angularjs.org

 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in
 all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 THE SOFTWARE.
 */
/**
 * Git COMMIT-MSG hook for validating commit message
 * See https://docs.google.com/document/d/1rk04jEuGfk9kYzfqCuOlPTSJw3hEDZJTBN5E5f1SALo/edit
 *
 * Installation:
 * >> cd <angular-repo>
 * >> ln -s ../../validate-commit-msg.js .git/hooks/commit-msg
 */

'use strict';

var fs = require('fs');
var util = require('util');


var MAX_LENGTH = 100;
var PATTERN = /^(?:fixup!\s*)?(\w*)(\(([\w\$\.\*/-]*)\))?\: (.*)$/;
var IGNORED = /^WIP\:|^Merge/;
var TYPES = {
    feat: true,
    fix: true,
    docs: true,
    style: true,
    refactor: true,
    perf: true,
    test: true,
    chore: true,
    revert: true
};


var error = function() {
    // gitx does not display it
    // http://gitx.lighthouseapp.com/projects/17830/tickets/294-feature-display-hook-error-message-when-hook-fails
    // https://groups.google.com/group/gitx/browse_thread/thread/a03bcab60844b812
    console.error('INVALID COMMIT MSG: ' + util.format.apply(null, arguments));
};


var validateMessage = function(message) {
    var isValid = true;

    if (IGNORED.test(message)) {
        console.log('Commit message validation ignored.');
        return true;
    }

    if (message.length > MAX_LENGTH) {
        error('is longer than %d characters !', MAX_LENGTH);
        isValid = false;
    }

    var match = PATTERN.exec(message);

    if (!match) {
        error('does not match "<type>(<scope>): <subject>" ! was: ' + message);
        return false;
    }

    var type = match[1];
    var scope = match[3];
    var subject = match[4];

    if (!TYPES.hasOwnProperty(type)) {
        error('"%s" is not allowed type !', type);
        return false;
    }

    // Some more ideas, do want anything like this ?
    // - allow only specific scopes (eg. fix(docs) should not be allowed ?
    // - auto correct the type to lower case ?
    // - auto correct first letter of the subject to lower case ?
    // - auto add empty line after subject ?
    // - auto remove empty () ?
    // - auto correct typos in type ?
    // - store incorrect messages, so that we can learn

    return isValid;
};


var firstLineFromBuffer = function(buffer) {
    return buffer.toString().split('\n').shift();
};



// publish for testing
exports.validateMessage = validateMessage;

// hacky start if not run by jasmine :-D
if (process.argv.join('').indexOf('jasmine-node') === -1) {
    var commitMsgFile = process.argv[2];
    var incorrectLogFile = commitMsgFile.replace('COMMIT_EDITMSG', 'logs/incorrect-commit-msgs');

    fs.readFile(commitMsgFile, function(err, buffer) {
        var msg = firstLineFromBuffer(buffer);

        if (!validateMessage(msg)) {
            fs.appendFile(incorrectLogFile, msg + '\n', function() {
                process.exit(1);
            });
        } else {
            process.exit(0);
        }
    });
}
