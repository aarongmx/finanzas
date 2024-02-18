import {expect, test} from 'vitest'


test('Se puede convertir un string a float', () => {
    let number = validNumber("10")

    expect(number).toBeTypeOf('number')
    expect(number).toBeCloseTo(10, 2)
})
test('Se puede convertir un string "100" a float', () => {
    let number = validNumber("100.45")
    console.info(number)
    expect(number).toBeTypeOf('number')
    expect(number).toBeCloseTo(100.45, 2)
})


test('Se puede convertir un NaN a 0', () => {
    let number = validNumber(NaN)

    expect(number).toBeTypeOf('number')
    expect(number).toBeCloseTo(0, 2)
})

test('Si el string esta vacío, se retorna 0', () => {
    let number = validNumber("")

    expect(number).toBeTypeOf('number')
    expect(number).toBeCloseTo(0, 2)
})

const validNumber = (value) => {
    let floatValue = parseFloat(value)
    return !isNaN(floatValue) ? parseFloat(floatValue.toFixed(2)) : 0
}
