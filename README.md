# Bevásárlás tervező

1. A hiányzó ételeket vedd fel az `\PeterPecosz\Kajatervezo\Etel` namespace-be
2. A hiányzó hozzávalókat add hozzá a `\PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo` class-hoz
   - A hozzávalót add hozzá a `HOZZAVALO_KATEGORIA` const-hoz
   - Amennyiben mértékegység preferenciát szeretnél definiálni,
     add hozzá a `MERTEKEGYSEG_PREFERENCE` const-hoz

Futtasd a következő command-ot:
```shell
bin/console plan:shopping
```
