
# Piggy PHP SDK #  
With [Piggy's](https://www.piggy.eu/) all-in-one platform you can strengthen loyalty and automate every step. From reward programs, to branded giftcards and smart email marketing - Piggy takes care of it all.

You can use this package to connect your application / POS-system (Register) to a Piggy account. Please make sure to choose the right API Client for your needs.

Full documentation about our API can be found here https://docs.piggy.eu/

## Setup ##  

**Composer:**
```
composer require piggy/piggy-php-sdk
```

## Quickstart ##  

**Example with Register Client**  
```
$apiKey = 'xxxx-xxxx-xxxx';  
$client = new Piggy\Api\RegisterClient($apiKey);

try {
    $member = $client->members->findOneBy(123, 'test@domain.com'); // Example call to find a member by email address
} catch(Piggy\Api\Exceptions\MaintenanceModeException $e) {
    // Catch maintenance mode specific.
} catch(Piggy\Api\Exceptions\PiggyRequestException $e) {
    // If no member is found for instance, you'd know that from this exception
} catch(\Exception $) {
    // Handle any other exceptions 
}

```

**Example with OAuth Client**  
```
$clientId = 'xxxx';
$clientSecret = 'xxx-xxxxxxx';    
$client = new Piggy\Api\OAuthClient($clientId, $clientSecret);  
$access_token = $client->getAccessToken();      
$client->setAccessToken($access_token);

try {
    $member = $client->members->findOneBy(123, 'test@domain.com'); // Example call to find a member by email address
} catch(Piggy\Api\Exceptions\MaintenanceModeException $e) {
    // Catch maintenance mode specific.
} catch(Piggy\Api\Exceptions\PiggyRequestException $e) {
    // If no member is found for instance, you'd know that from this exception
} catch(\Exception $) {
    // Handle any other exceptions 
}
```