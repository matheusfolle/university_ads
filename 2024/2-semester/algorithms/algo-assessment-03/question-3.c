#include <stdio.h>
#include <stdlib.h>
#include <locale.h>

#define n 3

typedef struct
{
    char city[30];
    char state[30];
} Location;

typedef struct
{
    char name[30];
    char cnpj[20];
    Location location;
} Enterprise;

void store_values(Enterprise ent[n])
{
    int i;

    for (i = 0; i < n; i++)
    {
        printf("Enterprise %d\n", i + 1);

        printf("Name: ");
        scanf(" %[^\n]", ent[i].name);

        printf("CNPJ: ");
        scanf(" %[^\n]", ent[i].cnpj);

        printf("City: ");
        scanf(" %[^\n]", ent[i].location.city);

        printf("State: ");
        scanf(" %[^\n]", ent[i].location.state);

        printf("\n");
    }
}

void show_all(Enterprise ent[n])
{
    int i;
    printf("\n--- Registered Enterprises ---\n");
    for (i = 0; i < n; i++)
    {
        printf("\nName: %s\n", ent[i].name);
        printf("CNPJ: %s\n", ent[i].cnpj);
        printf("City: %s\n", ent[i].location.city);
        printf("State: %s\n", ent[i].location.state);
    }
}

int main()
{
    setlocale(LC_ALL, "en_US.UTF-8");

    Enterprise ent[n];

    store_values(ent);
    show_all(ent);

    return 0;
}