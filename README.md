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

- `/wp-json/wcmtl-api/v1/basic`
- `/wp-json/wcmtl-api/v1/cats`

The `cats` endpoint accepts the following parameters:

- `/wp-json/wcmtl-api/v1/cats?q=<search term>`
- `/wp-json/wcmtl-api/v1/cats?colour=<colour slug>`
- `/wp-json/wcmtl-api/v1/cats?breed=<breed slug>`
- `/wp-json/wcmtl-api/v1/cats?pattern=<tabby slug>`
- `/wp-json/wcmtl-api/v1/cats?page=<page number>`

The parameters can be combined:

- `/wp-json/wcmtl-api/v1/cats?colour=<colour>&breed=<breed>&pattern=<tabby>`

These parameters will filter the results with the AND operator. 
There are 12 items per page.

## Sample Cat Data

```json
{
  "postCount": 2,
  "cats": [
    {
      "id": 9,
      "title": "Fitz",
      "excerpt": "Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Nam commodo suscipit quam. Nullam vel sem. Vivamus euismod mauris. Ut leo.",
      "content": "Sed ante. Vivamus tortor. Duis mattis egestas metus. Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.",
      "image": "https://example.com/wp-content/uploads/2023/10/fitz.jpg",
      "alt_text": "A brown scottish fold cat sitting on a sofa.",
      "breeds": [
        {
          "slug": "scottish-fold",
          "name": "Scottish Fold"
        }
      ],
      "colours": [
        {
          "slug": "brown",
          "name": "Brown"
        }
      ],
      "patterns": [
        {
          "slug": "colourpoint",
          "name": "Colourpoint"
        }
      ]
    },
    {
      "id": 8,
      "title": "Pekoe",
      "excerpt": "Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Sed in libero ut nibh placerat accumsan. Quisque id mi. Morbi mollis tellus ac sapien. Proin faucibus arcu quis ante.",
      "content": "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi. Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.", 
      "image": "https://example.com/wp-content/uploads/2023/10/pekoe.jpg",
      "alt_text": "An orange tabby cat sleeping on a pillow.",
      "breeds": [
        {
          "slug": "domestic-shorthair",
          "name": "Domestic Shorthair"
        }
      ],
      "colours": [
        {
          "slug": "orange",
          "name": "Orange"
        }
      ],
      "patterns": [
        {
          "slug": "tabby",
          "name": "Tabby"
        }
      ]
    }
  ]
}
```
## Sample Basic Data 

```json
{
  "cats": [
    {
      "name": "Pekoe",
      "colour": "orange",
      "breed": "domestic shorthair",
      "pattern": "tabby"
    },
    {
      "name": "Milo",
      "colour": "grey",
      "breed": "domestic shorthair",
      "pattern": "solid"
    },
    {
      "name": "Poppy",
      "colour": "cream",
      "breed": "siamese",
      "pattern": "pointed"
    }
  ]
}
```