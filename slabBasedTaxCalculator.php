<?php

/*
 * Slab based yearly Tax calculation
 * As per law in Bangladesh first 300000 is tax-free (for male)
 * Then 5% tax on next 100000
 * Then 10% tax on next 300000
 * Then 15% tax on next 400000
 * Then 20% tax on next 500000
 * Then 25% tax on remaining amount
 * Constraint 1: Tax slabs and tax rates must be same length
 * Constraint 2: Rest amount must be last item in tax slabs
 * Constraint 3: Rest amount must be last item in tax rates
 * Constraint 4: Rest amount must be 0
 * Algorithm:
    Initialize the tax to 0.
    For each tax slab and its corresponding tax rate, do the following:
    a. If the taxable salary is greater than 0, then check if it is less than the current slab or if the current slab is the last item in the tax slabs array.
    b. If it is less than the current slab, or it is the last item, then calculate the tax as the taxable salary multiplied by the current tax rate divided by 100.
    c. If not, then calculate the tax as the current slab multiplied by the current tax rate divided by 100.
    d. Deduct the current slab from the taxable salary.
    Return the calculated tax.

 * @param int $yearly_taxable_salary
 * @return float
 */
function calculateTax($yearly_taxable_salary): float
{
    $tax_slabs = [300000, 100000, 300000, 400000, 500000, 0];
    $tax_rates = [0, 5, 10, 15, 20, 25];
    $tax = 0;

    foreach ($tax_slabs as $i => $slab) {
        if ($yearly_taxable_salary > 0) {
            if ($yearly_taxable_salary < $slab || $slab === end($tax_slabs)) {
                $tax += ($yearly_taxable_salary * $tax_rates[$i])/ 100;
                break;
            } else {
                $tax += ($slab * $tax_rates[$i])/ 100;
            }
            $yearly_taxable_salary -= $slab;
        }
    }

    return $tax;
}

echo calculateTax(1700000);