# eve-swagger-interface-api
EVE Online Swagger Interface API Component
#####Component initializing
`$api = new \DenisKhodakovskiyESI\EVESwaggerAPI();`
####Character
To get a character instance you just have to call `character` method of the API:
`$character = $api->character($characterId, [$token = null]);`

**Character::info(): CharacterInfo**

`$character->info()`