## Craft Embed.ly plugin

Use Embed.ly to fetch information and embed content from 250+ services.

### Usage

You can provide one url, like so:

```
{% set single = craft.embedly.oembed('https://vimeo.com/4076405') %}
<h1>Single url</h2>
<ul>
{% for key,value in single|sort %}
    <li>{{ key }}: {{ value }}</li>
{% endfor %}
</ul>
```

...or send off a whole array:
```
{% set multiple = craft.embedly.oembed([
    'https://vimeo.com/19026280', 
    'https://www.youtube.com/watch?v=DsY22N5D9UY', 
    'http://www.wired.com/2015/02/field-guide-internet-infrastructure-hides-plain-sight/'
]) %}

<h1>Multiple url's</h1>
{% for service,values in multiple|sort %}
    <h2>{{ values.provider_name }} – {{ values.type }}</h2>
    <ul>
        {% for key,value in values %}
            <li>{{key}}: {{ value }}</li>
        {% endfor %}
    </ul>
{% endfor %}
```