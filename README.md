# wcmtl-api
Word Camp Montreal 2023. Plugin to demo custom API endpoints in WordPress.

## Installation
1. Download the plugin as a zip file.
2. Upload the zip file to your WordPress site. (Preferably a local development site.)
3. Activate the plugin.
4. Create some new content in "Cats".
5. Add some taxonomy terms to cats. (Colours, Breeds and Patterns)

## Usage

Visit the following endpoints to see the data in JSON format.
Note: Use [Firefox](https://www.mozilla.org/) or Chrome with the [JSONvue extension](https://chrome.google.com/webstore/detail/jsonvue/chklaanhfefbnpoihckbnefhakgolnmc) to view the JSON in a readable format.

`/wp-json/wcmtl-api/v1`

`/wp-json/wcmtl-api/v1/basic`
`/wp-json/wcmtl-api/v1/cats`

The `cats` endpoint accepts the following parameters:

`/wp-json/wcmtl-api/v1/cats?colour=<colour>`
`/wp-json/wcmtl-api/v1/cats?breed=<breed>`
`/wp-json/wcmtl-api/v1/cats?pattern=<tabby>`

The parameters can be combined:

`/wp-json/wcmtl-api/v1/cats?colour=<colour>&breed=<breed>&pattern=<tabby>`

These parameters will filter the results with the AND operator.
