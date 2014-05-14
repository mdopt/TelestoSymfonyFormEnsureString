Symfony form type extension which substitutes non-string data with default value for requested form types.


Problem:

Symfony framework by default does not protect your application from type errors in your forms.

If someone adds '[]' to form input name (using firebug, opera dragonfly or similar tool), the data sent to
your application will be an array instead of string and (most likely) some validator will throw Symfony\Component\Validator\Exception\UnexpectedTypeException, which (if uncaught) will result in 500 Internal server error http response and 'Uncaught PHP Exception' entry log.

    Example:
    
    ``name="form_name[field_name]"`` (normal input name)
    
    ``name="form_name[field_name][]"`` (modified input name)

But you probably don't want that error in your logs, and you don't want your application to send 5xx response,
because it is not (semantically) a server error.


Possible solutions:

1. Use try-catch block for every ``$form->submit()`` to catch UnexpectedTypeException (which is dirty).
2. Wrap your form in another form that does exception catching for you and returns appropriate error.
You could use a custom form factory to do that automatically.
3. Use form type extension that fixes non-string values.

This project provides solution number 3.


Usage:

```
services:
    ...
    
    form.type_extention.ensure_string:
        class:  Telesto\VendorExt\Symfony\Form\EnsureString\Type\FormTypeEnsureStringExtension
        arguments:
            - ['text', 'integer', 'hidden', 'number', 'percent', 'money'] # add non-standard types if you use them
        tags:
            - { name: form.type_extension, alias: form }
```


License: MIT
