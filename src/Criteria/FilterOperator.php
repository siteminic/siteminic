<?php

declare(strict_types=1);

namespace Siteminic\Criteria;

enum FilterOperator
{
    case EQUAL;
    case NOT_EQUAL;
    case GT;
    case GTE;
    case LT;
    case LTE;
    case CONTAINS;
    case NOT_CONTAINS;
}
