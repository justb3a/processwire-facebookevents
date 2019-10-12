# WARNING: This repository is no longer maintained :warning:

> This repository will not be updated. The repository will be kept available in read-only mode.

# ProcessWire FacebookEvents

ProcessWire module to get Facebook Page Events using the Graph API.

## Create an app on Facebook developers website

You have to create an app to get appId and appSecret. Those keys are required.  
Go to [Facebook Developers](https://developers.facebook.com/) and add a new app.  
Congrats! Now you can copy your Facebook appId and appSecret.

## Get your Facebook page ID 

You can either enter your facebook page ID or the facebook page name.  
If you enter the Facebook page name, this module will get the page ID for you!

## Call Module

```php
$events = $modules->get('FacebookEvents')->getEvents();
```

## Output Events

```php
echo "<ul>";
foreach ($events as $event) {
  echo "<li>{$event['name']}</li>";
}
echo "</ul>";
```

```twig
{% for event in events|reverse %}
  {% if event.start_time|date('U') > date().timestamp %}
    <div>
      {% set dts = modules.get('FacebookEvents').getDates(event) %}
      <a href="https://www.facebook.com/events/{{event.id}}/" title="Facebook">{{dts.dates}}:</a>
      {{event.name}} <em>{{dts.times}}</em>
    </div>
  {% endif %}
{% endfor %}
```

## Format / Combine Start and End Date

```php
$dts = $modules->get('FacebookEvents')->getDates($event);
```

**Parameter:**

| param       | type   | required | default | description           |
|-------------|--------|----------|---------|-----------------------|
| $event      | array  | true     | /       | current event (loop)  |
| $formatDate | string | false    | d.m.Y   | date format           |
| $formatTime | string | false    | H:i     | time format           |
| $divider    | string | false    | -       | date / time separator |

**Result:**

array with keys:

- dates
- times

**Example Output:**

```html
<!-- one-day event -->
<div>
  <a href="https://www.facebook.com/events/xxx/" title="xxx">07.01.2017:</a>
  event title <em>12:00 - 16:00Uhr</em>
</div>

<!-- multi-day event -->
 <div>
  <a href="https://www.facebook.com/events/xxx/" title="xxx">01.07.2017 - 02.07.2017:</a>
  another event title <em>09:30 - 17:00</em>
</div>
```
