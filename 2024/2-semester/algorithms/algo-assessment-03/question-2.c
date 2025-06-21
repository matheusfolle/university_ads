#include <stdio.h>
#include <stdlib.h>
#include <locale.h>
#include <math.h>

float adjustment(int age, float gross_salary, char marital_status)
{
    if ((age >= 5) && (marital_status == 'M' || marital_status == 'm'))
    {
        return gross_salary * 1.12;
    }
    else
    {
        return gross_salary * 1.075;
    }
}

int main(int argc, char *argv[])
{
    setlocale(LC_ALL, "en_US.UTF-8");

    char name[50], marital_status;
    int age, option;
    float gross_salary, new_sal;

    do
    {
        printf("Enter the employee's name:\n");
        scanf(" %[^\n]", name);

        do
        {
            printf("Enter the gross salary:\n");
            scanf("%f", &gross_salary);
        } while (gross_salary <= 0);

        do
        {
            printf("How many years have they been at the company?\n");
            scanf("%d", &age);
        } while (age <= 0);

        do
        {
            printf("Enter marital status (S - Single / M - Married):\n");
            scanf(" %c", &marital_status);
        } while ((marital_status != 'S') && (marital_status != 's') &&
                 (marital_status != 'M') && (marital_status != 'm'));

        new_sal = adjustment(age, gross_salary, marital_status);

        printf("The new salary of employee %s is R$ %.2f\n", name, new_sal);

        printf("Do you want to calculate the raise for another employee? (1 - Yes, 2 - No)\n");
        scanf("%d", &option);

    } while (option == 1);

    return 0;
}