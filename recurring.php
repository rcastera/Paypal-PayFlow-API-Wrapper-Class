<?php
/**
 * Recurring Transaction
 */

require_once('Class.PayFlow.php');

// Recurring Transaction
$PayFlow = new PayFlow('VENDOR', 'PARTNER', 'USER', 'PASSWORD', 'recurring');

$PayFlow->setEnvironment('test');                           // test or live
$PayFlow->setTransactionType('R');                          // S = Sale transaction, R = Recurring, C = Credit, A = Authorization, D = Delayed Capture, V = Void, F = Voice Authorization, I = Inquiry, N = Duplicate transaction
$PayFlow->setPaymentMethod('C');                            // A = Automated clearinghouse, C = Credit card, D = Pinless debit, K = Telecheck, P = PayPal.
$PayFlow->setPaymentCurrency('USD');                        // 'USD', 'EUR', 'GBP', 'CAD', 'JPY', 'AUD'.

// Only used for recurring transactions
$PayFlow->setProfileAction('A');
$PayFlow->setProfileName('Richard_Castera');
$PayFlow->setProfileStartDate(date('mdY', strtotime("+1 day")));
$PayFlow->setProfilePayPeriod('MONT');
$PayFlow->setProfileTerm(0);

$PayFlow->setAmount('15.00', FALSE);
$PayFlow->setCCNumber('378282246310005');
$PayFlow->setCVV('4685');
$PayFlow->setExpiration('1112');
$PayFlow->setCreditCardName('Richard Castera');

$PayFlow->setCustomerFirstName('Richard');
$PayFlow->setCustomerLastName('Castera');
$PayFlow->setCustomerAddress('589 8th Ave Suite 10');
$PayFlow->setCustomerCity('New York');
$PayFlow->setCustomerState('NY');
$PayFlow->setCustomerZip('10018');
$PayFlow->setCustomerCountry('US');
$PayFlow->setCustomerPhone('212-123-1234');
$PayFlow->setCustomerEmail('richard.castera@gmail.com');
$PayFlow->setPaymentComment('New Monthly Transaction');

if($PayFlow->processTransaction()):
  echo('Transaction Processed Successfully!');
else:
  echo('Transaction could not be processed at this time.');
endif;
 
echo('<h2>Name Value Pair String:</h2>');
echo('<pre>');
print_r($PayFlow->debugNVP('array'));
echo('</pre>');
 
echo('<h2>Response From Paypal:</h2>');
echo('<pre>');
print_r($PayFlow->getResponse());
echo('</pre>');
 
unset($PayFlow);
?>