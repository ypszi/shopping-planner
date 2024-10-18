<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg;

enum Mertekegyseg: string
{
    case DB = 'db';
    case CSIPET = 'csipet';
    case GEREZD = 'gerezd';
    case KONZERV = 'konzerv';
    case CSOMAG = 'csomag';
    /* késhegy */
    case KH = 'kh';
    /* tömeg */
    case G = 'g';
    case DKG = 'dkg';
    case KG = 'kg';
    /* űrtartalom */
    case CSEPP = 'csepp';
    case ML = 'ml';
    case CL = 'cl';
    case DL = 'dl';
    case L = 'l';
    /* pohár */
    case CSESZE = 'csésze';
    case BOGRE = 'bögre';
    /* kanál */
    // Mokkás kanál
    case MK = 'mk';
    // Kis kanál
    case KK = 'kk';
    // Teás kanál
    case TK = 'tk';
    // Kávés kanál
    case KVK = 'kvk';
    // Evőkanál
    case EK = 'ek';
}
