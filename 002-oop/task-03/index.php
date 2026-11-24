<?php

require_once __DIR__ . '/exceptions.php';

function calculate($value)
{
    if (is_int($value)) {
        throw new IntException('передано целое число (int)');
    }

    if (is_float($value)) {
        throw new FloatException('передано дробное число (float)');
    }

    if (is_string($value)) {
        throw new StringException('передана строка (string)');
    }

    if (is_bool($value)) {
        throw new BoolException('передано булево значение (bool)');
    }

    if (is_array($value)) {
        throw new ArrayException('передан массив (array)');
    }

    if (is_null($value)) {
        throw new NullException('передан null');
    }
}

$values = [42, 3.14, 'PHP', true, [1, 2, 3], null];

foreach ($values as $value) {
    try {
        calculate($value);
    } catch (IntException $e) {
        echo 'int: ', $e->getMessage(), "\n";
    } catch (FloatException $e) {
        echo 'float: ', $e->getMessage(), "\n";
    } catch (StringException $e) {
        echo 'string: ', $e->getMessage(), "\n";
    } catch (BoolException $e) {
        echo 'bool: ', $e->getMessage(), "\n";
    } catch (ArrayException $e) {
        echo 'array: ', $e->getMessage(), "\n";
    } catch (NullException $e) {
        echo 'null: ', $e->getMessage(), "\n";
    }
}
