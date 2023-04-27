<?php declare(strict_types=1);

require_once SRC_DIR . DS . 'emails' . DS . 'check_email.php';

function test_syntax_correct()
{
    assert(check_email_syntax('test@examile.com'), 'incorrect email');
}

function test_syntax_prohibited_chars()
{
    assert(!check_email_syntax('|test@examile.com'), 'email contains prohibited chars');
}

function test_correct_email_domain()
{
    assert(check_email_domain('test@gmail.com'), 'Wrong email domain');
}

function test_incorrect_email_domain()
{
    assert(!check_email_domain('test@is.not'), 'Wrong email domain');
}
