UmbrellawebCustomFormTypesBundle
========================

# OVERVIEW

**UmbrellawebCustomFormTypesBundle** - extends the default Symfony 2 form types & customizes some form templates rendering.

# REQUIREMENTS

HTMLPurifierBundle [see here](https://github.com/Exercise/HTMLPurifierBundle)

# AVAILABLE FORM TYPES:

1. `tree` type, extends 'entity' type

2. `recaptcha` type, extends 'form' type

You must define your private_key and public_key in config file

    # app/config/config.yml
    umbrellaweb_bundle_custom_form_types:
        recaptcha:
            private_key: "your-private-key"
            public_key:  "your-public-key"

Original source for 'recaptcha' type was took from [here] (https://github.com/simplethings/SimpleThingsFormExtraBundle)

3. `us_states` type, extends 'choice' type

If you want to add list of states on another language, you must create your own file with name 'us_states.%your_locale%.yml' in 'Resources/data/states' directory and define list of states in this file.

4. `web_url` type, extends 'url' type

If field value is null, rendered 'http://' placeholder

5. `hidden_entity` type, extends 'hidden' type

6. `year` type, extends 'choice' type

7. `wysiwyg` type, extends 'textarea'

8. `datepicker` type, extends `date` type. Set default options values: `widget => single_text`, `format => MM/dd/yyyy`.

# FORM BLOCKS OVERRIDES:

- the bundle overrides form `choice_widget_options` block rendering so that the entity choices have a data-attribute `data-slug = entity.slug` (in case of entity has a slug). This helps to build more clear & usable js-scripts for forms.

# FORM EXTENSIONS

- help form type extension. Registers a `help` option for `form`, so that you can set it in fields definition & render as described [here](http://symfony.com/doc/current/cookbook/form/form_customization.html#adding-help-messages) 

#INSTALLATION

register the Bundle UmbrellawebCustomFormTypesBundle in app/AppKernel.php:

    new Umbrellaweb\Bundle\CustomFormTypesBundle\UmbrellawebBundleCustomFormTypesBundle(),
