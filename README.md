Communication Bundle
========================

Przykładowa konfiguracja
--------------

```
ow_communication:
    message_author_email: no-reply@oskarwegner.pl
    max_messages_to_send: 5
    max_error_count: 3

```

Twig Extension: Drogi / Droga
--------------

Przykładowe użycie:

```
{{ user.name | salutation }}
```

Twig Extension: Wołacz
--------------

Przykładowe użycie:

```
{{ user.name | vocative }}
```
