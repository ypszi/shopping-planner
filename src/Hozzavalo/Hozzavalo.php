<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Hozzavalo
{
    /* ZOLDSEG */
    final public const string BROKKOLI = 'Brokkoli';
    final public const string BURGONYA = 'Burgonya';
    final public const string CITROM = 'Citrom';
    final public const string EDESBURGONYA = 'Édesburgonya';
    final public const string FEHERREPA = 'Fehérrépa';
    final public const string FOKHAGYMA = 'Fokhagyma';
    final public const string HEGYES_PAPRIKA = 'Hegyes paprika';
    final public const string JEGSALATA = 'Jégsaláta';
    final public const string KAPOSZTA = 'Káposzta';
    final public const string KARALABE = 'Karalabé';
    final public const string KIGYOUBORKA = 'Kigyóuborka';
    final public const string KOKTELPARADICSOM = 'Koktélparadicsom';
    final public const string LILAHAGYMA = 'Lilahagyma';
    final public const string PAPRIKA = 'Paprika';
    final public const string PARADICSOM = 'Paradicsom';
    final public const string REPA = 'Répa';
    final public const string SAVANYU_KAPOSZTA = 'Savanyú káposzta';
    final public const string VOROSHAGYMA = 'Vöröshagyma';
    final public const string ZELLER = 'Zeller';

    /* FUSZER_ES_OLAJ */
    final public const string BABERLEVEL = 'Babérlevél';
    final public const string CAYENNE_BORS = 'Cayenne bors';
    final public const string CHILI = 'Chili';
    final public const string FUSZERKOMENY = 'Fűszerkömény';
    final public const string FUSZER_PAPRIKA = 'Piros paprika';
    final public const string GYOMBER_POR = 'Gyömbér por';
    final public const string KAKUKKFU = 'Kakukkfű';
    final public const string NAPRAFORGO_OLAJ = 'Napraforgó olaj';
    final public const string OLIVA_OLAJ = 'Olíva olaj';
    final public const string OREGANO = 'Oregánó';
    final public const string PIROS_PAPRIKA = 'Piros paprika';
    final public const string SZERECSENDIO = 'Szerecsendió';
    final public const string ZOLDFUSZER = 'Zöldfűszer';

    /* HOSSZU_SOROK */
    final public const string BARACK_LEKVAR = 'Baracklekvár';
    final public const string CUKOR = 'Cukor';
    final public const string FEHERBOR = 'Fehérbor';
    final public const string FINOMLISZT = 'Finomliszt';
    final public const string KEMENYITO = 'Keményítő';
    final public const string LISZT = 'Finomliszt';
    final public const string MEZ = 'Méz';
    final public const string PENNE_TESZTA = 'Penne tészta';
    final public const string PORCUKOR = 'Porcukor';
    final public const string RIZS = 'Rizs';
    final public const string SUTOPOR = 'Sütőpor';
    final public const string SZEZAMMAG = 'Szezámmag';
    final public const string SZOJASZOSZ = 'Szójaszósz';
    final public const string VANILIAS_CUKOR = 'Vaníliás cukor';

    /* HUS */
    final public const string DARALT_HUS = 'Darált hús';
    final public const string CSIRKEMELL = 'Csirkemell';
    final public const string KOLBASZ = 'Kolbász';
    final public const string KOLOZSVARI_SZALONNA = 'Kolozsvári szalonna';
    final public const string LAZAC = 'Lazac';
    final public const string SERTES_ZSIR = 'Sertészsír';

    /* HUTOS */
    final public const string FETA_SAJT = 'Feta sajt';
    final public const string NATUR_JOGHURT = 'Natúr joghurt';
    final public const string PARMEZAN = 'Parmezán';
    final public const string TEJFOL = 'Tejföl';
    final public const string TOJAS = 'Tojás';

    /* HUTOS_UTAN */
    final public const string FOZO_TEJSZIN = 'Főzőtejszín';
    final public const string KETCHUP = 'Ketchup';
    final public const string TEJ = 'Tej';
    final public const string TEJSZIN = 'Főzőtejszín';

    /** @var array<string, string> */
    final public const array MERTEKEGYSEG_PREFERENCE = [
        Hozzavalo::CSIRKEMELL      => Mertekegyseg::KG,
        Hozzavalo::CUKOR           => Mertekegyseg::KG,
        Hozzavalo::DARALT_HUS      => Mertekegyseg::KG,
        Hozzavalo::LISZT           => Mertekegyseg::KG,
        Hozzavalo::NAPRAFORGO_OLAJ => Mertekegyseg::DL,
        Hozzavalo::OLIVA_OLAJ      => Mertekegyseg::DL,
        Hozzavalo::RIZS            => Mertekegyseg::KG,
    ];

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

    public static function fromHozzavaloWithMennyiseg(Hozzavalo $hozzavalo, float $mennyiseg): self
    {
        return new self($hozzavalo->getKategoria(), $hozzavalo->getNev(), $mennyiseg, $hozzavalo->getMertekegyseg());
    }

    public static function fromHozzavaloWithMertekegyseg(Hozzavalo $hozzavalo, string $mertekegyseg): self
    {
        return new self($hozzavalo->getKategoria(), $hozzavalo->getNev(), $hozzavalo->getMennyiseg(), $mertekegyseg);
    }

    public static function fromHozzavalo(Hozzavalo $hozzavalo, float $mennyiseg, string $mertekegyseg): self
    {
        return new self($hozzavalo->getKategoria(), $hozzavalo->getNev(), $mennyiseg, $mertekegyseg);
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
