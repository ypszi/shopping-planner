<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

class Hozzavalo
{
    /* ZOLDSEG */
    final public const string VOROSHAGYMA = 'Vöröshagyma';
    final public const string FOKHAGYMA = 'Fokhagyma';
    final public const string PAPRIKA = 'Paprika';
    final public const string PARADICSOM = 'Paradicsom';
    final public const string REPA = 'Répa';
    final public const string FEHERREPA = 'Fehérrépa';
    final public const string KARALABE = 'Karalabé';
    final public const string ZELLER = 'Zeller';
    final public const string CITROM = 'Citrom';
    final public const string JEGSALATA = 'Jégsaláta';
    final public const string KIGYOUBORKA = 'Kigyóuborka';
    final public const string KOKTELPARADICSOM = 'Koktélparadicsom';
    final public const string LILAHAGYMA = 'Lilahagyma';
    final public const string BROKKOLI = 'Brokkoli';
    final public const string EDESBURGONYA = 'Édesburgonya';
    final public const string BURGONYA = 'Burgonya';
    final public const string HEGYES_PAPRIKA = 'Hegyes paprika';
    /* FUSZER_ES_OLAJ */
    final public const string CHILI = 'Chili';
    final public const string NAPRAFORGO_OLAJ = 'Napraforgó olaj';
    final public const string PIROS_PAPRIKA = 'Piros paprika';
    final public const string FUSZER_PAPRIKA = 'Piros paprika';
    final public const string KAKUKKFU = 'Kakukkfű';
    /* HOSSZU_SOROK */
    final public const string FEHERBOR = 'Fehérbor';
    final public const string PENNE_TESZTA = 'Penne tészta';
    final public const string SUTOPOR = 'Sütőpor';
    final public const string KEMENYITO = 'Keményítő';
    final public const string MEZ = 'Méz';
    final public const string SZEZAMMAG = 'Szezámmag';
    final public const string FINOMLISZT = 'Finomliszt';
    final public const string LISZT = 'Finomliszt';
    /* HUS */
    final public const string CSIRKEMELL = 'Csirkemell';
    final public const string DARALT_HUS = 'Darált hús';
    final public const string LAZAC = 'Lazac';
    /* HUTOS */
    final public const string TEJFOL = 'Tejföl';
    final public const string PARMEZAN = 'Parmezán';
    final public const string TOJAS = 'Tojás';
    /* HUTOS_UTAN */
    final public const string TEJSZIN = 'Főzőtejszín';
    final public const string FOZO_TEJSZIN = 'Főzőtejszín';
    final public const string KETCHUP = 'Ketchup';

    private string $kategoria;

    private string $nev;

    private float $mennyiseg;

    private string $mertekegyseg;

    public function __construct(string $kategoria, string $name, float $mennyiseg, string $mertekegyseg)
    {
        $this->kategoria    = $kategoria;
        $this->nev          = $name;
        $this->mennyiseg    = $mennyiseg;
        $this->mertekegyseg = $mertekegyseg;
    }

    public static function fromHozzavalo(Hozzavalo $hozzavalo, float $mennyiseg): self
    {
        return new self($hozzavalo->getKategoria(), $hozzavalo->getNev(), $mennyiseg, $hozzavalo->getMertekegyseg());
    }

    public function getKategoria(): string
    {
        return $this->kategoria;
    }

    public function getNev(): string
    {
        return $this->nev;
    }

    public function getMennyiseg(): float
    {
        return $this->mennyiseg;
    }

    public function getMertekegyseg(): string
    {
        return $this->mertekegyseg;
    }

    public function __toString(): string
    {
        return sprintf('%.2f %s %s', $this->mennyiseg, $this->mertekegyseg, $this->nev);
    }
}
