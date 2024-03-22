<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

use PeterPecosz\Kajatervezo\Hozzavalo\Exception\UnknownHozzavaloException;
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
    final public const string KRUMPLI = 'Burgonya';
    final public const string LILAHAGYMA = 'Lilahagyma';
    final public const string PAPRIKA = 'Paprika';
    final public const string PARADICSOM = 'Paradicsom';
    final public const string POREHAGYMA = 'Póréhagyma';
    final public const string SARGAREPA = 'Sárgarépa';
    final public const string SAVANYU_KAPOSZTA = 'Savanyú káposzta';
    final public const string VOROSHAGYMA = 'Vöröshagyma';
    final public const string ZELLER = 'Zeller';
    final public const string ZELLERSZAR = 'Zellerszár';
    final public const string ZOLDBORSO = 'Zöldborsó';
    /* FUSZER_ES_OLAJ */
    final public const string BABERLEVEL = 'Babérlevél';
    final public const string CAYENNE_BORS = 'Cayenne bors';
    final public const string CHILI = 'Chili';
    final public const string EROLEVES_KOCKA = 'Erőleves kocka';
    final public const string FUSZERKEVEREK = 'Fűszerkeverék';
    final public const string FUSZERKOMENY = 'Fűszerkömény';
    final public const string FUSZER_PAPRIKA = 'Piros paprika';
    final public const string GYOMBER_POR = 'Gyömbér por';
    final public const string HUSLEVES_KOCKA = 'Húsleves kocka';
    final public const string KAKUKKFU = 'Kakukkfű';
    final public const string NAPRAFORGO_OLAJ = 'Napraforgó olaj';
    final public const string OLIVA_OLAJ = 'Olíva olaj';
    final public const string OREGANO = 'Oregánó';
    final public const string PETREZSELYEM = 'Petrezselyem';
    final public const string PIROS_PAPRIKA = 'Piros paprika';
    final public const string SZERECSENDIO = 'Szerecsendió';
    final public const string TARKONY = 'Tárkony';
    final public const string ZOLDFUSZER = 'Zöldfűszer';
    /* HOSSZU_SOROK */
    final public const string BARACK_LEKVAR = 'Baracklekvár';
    final public const string CUKOR = 'Cukor';
    final public const string FEHERBOR = 'Fehérbor';
    final public const string FINOMLISZT = 'Finomliszt';
    final public const string KEMENYITO = 'Keményítő';
    final public const string KUKORICA = 'Kukorica';
    final public const string LISZT = 'Finomliszt';
    final public const string MEZ = 'Méz';
    final public const string PARADICSOM_PURE = 'Paradicsom püré';
    final public const string PENNE_TESZTA = 'Penne tészta';
    final public const string PORCUKOR = 'Porcukor';
    final public const string RIZS = 'Rizs';
    final public const string SUTOPOR = 'Sütőpor';
    final public const string SZEZAMMAG = 'Szezámmag';
    final public const string SZOJASZOSZ = 'Szójaszósz';
    final public const string VANILIAS_CUKOR = 'Vaníliás cukor';
    final public const string VOROSBAB = 'Vörösbab';
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
    final public const string KEFIR = 'Kefír';
    final public const string PARMEZAN = 'Parmezán';
    final public const string TEJFOL = 'Tejföl';
    final public const string TOJAS = 'Tojás';
    /* HUTOS_UTAN */
    final public const string FOZO_TEJSZIN = 'Főzőtejszín';
    final public const string HABTEJSZIN = 'Habtejszín';
    final public const string KETCHUP = 'Ketchup';
    final public const string TEJ = 'Tej';
    final public const string TEJSZIN = 'Főzőtejszín';
    final public const string VAJ = 'Vaj';
    /** @var array<string, string> */
    final public const array MERTEKEGYSEG_PREFERENCE = [
        self::CSIRKEMELL      => Mertekegyseg::KG,
        self::CUKOR           => Mertekegyseg::KG,
        self::DARALT_HUS      => Mertekegyseg::KG,
        self::KUKORICA        => Mertekegyseg::G,
        self::LISZT           => Mertekegyseg::KG,
        self::NAPRAFORGO_OLAJ => Mertekegyseg::DL,
        self::OLIVA_OLAJ      => Mertekegyseg::DL,
        self::RIZS            => Mertekegyseg::KG,
        self::VOROSBAB        => Mertekegyseg::G,
    ];
    private const array HOZZAVALO_KATEGORIA = [
        self::BROKKOLI            => HozzavaloKategoria::ZOLDSEG,
        self::BURGONYA            => HozzavaloKategoria::ZOLDSEG,
        self::CITROM              => HozzavaloKategoria::ZOLDSEG,
        self::EDESBURGONYA        => HozzavaloKategoria::ZOLDSEG,
        self::FEHERREPA           => HozzavaloKategoria::ZOLDSEG,
        self::FOKHAGYMA           => HozzavaloKategoria::ZOLDSEG,
        self::HEGYES_PAPRIKA      => HozzavaloKategoria::ZOLDSEG,
        self::JEGSALATA           => HozzavaloKategoria::ZOLDSEG,
        self::KAPOSZTA            => HozzavaloKategoria::ZOLDSEG,
        self::KARALABE            => HozzavaloKategoria::ZOLDSEG,
        self::KIGYOUBORKA         => HozzavaloKategoria::ZOLDSEG,
        self::KOKTELPARADICSOM    => HozzavaloKategoria::ZOLDSEG,
        self::LILAHAGYMA          => HozzavaloKategoria::ZOLDSEG,
        self::PAPRIKA             => HozzavaloKategoria::ZOLDSEG,
        self::PARADICSOM          => HozzavaloKategoria::ZOLDSEG,
        self::POREHAGYMA          => HozzavaloKategoria::ZOLDSEG,
        self::SARGAREPA           => HozzavaloKategoria::ZOLDSEG,
        self::SAVANYU_KAPOSZTA    => HozzavaloKategoria::ZOLDSEG,
        self::VOROSHAGYMA         => HozzavaloKategoria::ZOLDSEG,
        self::ZELLER              => HozzavaloKategoria::ZOLDSEG,
        self::ZELLERSZAR          => HozzavaloKategoria::ZOLDSEG,
        self::ZOLDBORSO           => HozzavaloKategoria::ZOLDSEG,
        self::BABERLEVEL          => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::CAYENNE_BORS        => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::CHILI               => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::EROLEVES_KOCKA      => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::FUSZERKEVEREK       => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::FUSZERKOMENY        => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::GYOMBER_POR         => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::HUSLEVES_KOCKA      => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::KAKUKKFU            => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::NAPRAFORGO_OLAJ     => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::OLIVA_OLAJ          => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::OREGANO             => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::PETREZSELYEM        => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::PIROS_PAPRIKA       => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::SZERECSENDIO        => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::TARKONY             => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::ZOLDFUSZER          => HozzavaloKategoria::FUSZER_ES_OLAJ,
        self::BARACK_LEKVAR       => HozzavaloKategoria::HOSSZU_SOROK,
        self::CUKOR               => HozzavaloKategoria::HOSSZU_SOROK,
        self::FEHERBOR            => HozzavaloKategoria::HOSSZU_SOROK,
        self::KEMENYITO           => HozzavaloKategoria::HOSSZU_SOROK,
        self::KUKORICA            => HozzavaloKategoria::HOSSZU_SOROK,
        self::LISZT               => HozzavaloKategoria::HOSSZU_SOROK,
        self::MEZ                 => HozzavaloKategoria::HOSSZU_SOROK,
        self::PARADICSOM_PURE     => HozzavaloKategoria::HOSSZU_SOROK,
        self::PENNE_TESZTA        => HozzavaloKategoria::HOSSZU_SOROK,
        self::PORCUKOR            => HozzavaloKategoria::HOSSZU_SOROK,
        self::RIZS                => HozzavaloKategoria::HOSSZU_SOROK,
        self::SUTOPOR             => HozzavaloKategoria::HOSSZU_SOROK,
        self::SZEZAMMAG           => HozzavaloKategoria::HOSSZU_SOROK,
        self::SZOJASZOSZ          => HozzavaloKategoria::HOSSZU_SOROK,
        self::VANILIAS_CUKOR      => HozzavaloKategoria::HOSSZU_SOROK,
        self::VOROSBAB            => HozzavaloKategoria::HOSSZU_SOROK,
        self::DARALT_HUS          => HozzavaloKategoria::HUS,
        self::CSIRKEMELL          => HozzavaloKategoria::HUS,
        self::KOLBASZ             => HozzavaloKategoria::HUS,
        self::KOLOZSVARI_SZALONNA => HozzavaloKategoria::HUS,
        self::LAZAC               => HozzavaloKategoria::HUS,
        self::SERTES_ZSIR         => HozzavaloKategoria::HUS,
        self::FETA_SAJT           => HozzavaloKategoria::HUTOS,
        self::NATUR_JOGHURT       => HozzavaloKategoria::HUTOS,
        self::KEFIR               => HozzavaloKategoria::HUTOS,
        self::PARMEZAN            => HozzavaloKategoria::HUTOS,
        self::TEJFOL              => HozzavaloKategoria::HUTOS,
        self::TOJAS               => HozzavaloKategoria::HUTOS,
        self::FOZO_TEJSZIN        => HozzavaloKategoria::HUTOS_UTAN,
        self::HABTEJSZIN          => HozzavaloKategoria::HUTOS_UTAN,
        self::KETCHUP             => HozzavaloKategoria::HUTOS_UTAN,
        self::TEJ                 => HozzavaloKategoria::HUTOS_UTAN,
        self::VAJ                 => HozzavaloKategoria::HUTOS_UTAN,
    ];

    private string $kategoria;

    private string $nev;

    private float $mennyiseg;

    private string $mertekegyseg;

    public function __construct(string $name, float $mennyiseg, string $mertekegyseg)
    {
        if (!isset(self::HOZZAVALO_KATEGORIA[$name])) {
            throw new UnknownHozzavaloException(sprintf('Unknown hozzavalo, cannot determine kategoria for "%s"', $name));
        }

        $this->kategoria    = self::HOZZAVALO_KATEGORIA[$name];
        $this->nev          = $name;
        $this->mennyiseg    = $mennyiseg;
        $this->mertekegyseg = $mertekegyseg;
    }

    public static function fromHozzavaloWithMennyiseg(Hozzavalo $hozzavalo, float $mennyiseg): self
    {
        return new self($hozzavalo->getNev(), $mennyiseg, $hozzavalo->getMertekegyseg());
    }

    public static function fromHozzavaloWithMertekegyseg(Hozzavalo $hozzavalo, string $mertekegyseg): self
    {
        return new self($hozzavalo->getNev(), $hozzavalo->getMennyiseg(), $mertekegyseg);
    }

    public static function fromHozzavalo(Hozzavalo $hozzavalo, float $mennyiseg, string $mertekegyseg): self
    {
        return new self($hozzavalo->getNev(), $mennyiseg, $mertekegyseg);
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
