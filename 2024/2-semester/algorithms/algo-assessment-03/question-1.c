#include <stdio.h>
#include <stdlib.h>
#include <locale.h>
#include <math.h>

void header() {
    printf("Positivo University\n");
    printf("Subject: Programming Logic and Algorithms\n");
    printf("Professor: Fábio Kravetz\n\n\n");
}

float calc_avg_gpa(float score1, float score2, float score3, char option) {
    float avg = 0.0;

    if (option == 'A' || option == 'a') {
        avg = (score1 + score2 + score3) / 3;
    } else if (option == 'P' || option == 'p') {
        avg = ((score1 * 5) + (score2 * 3) + (score3 * 2)) / 10;
    } else if (option == 'H' || option == 'h') {
        avg = 3.0 / ((1.0 / score1) + (1.0 / score2) + (1.0 / score3));
    }

    return avg;
}

int main() {
    setlocale(LC_ALL, "en_US.UTF-8");

    float score1, score2, score3, avg;
    char choice;

    header();

    do {
        printf("Enter the first grade:\n");
        scanf("%f", &score1);
    } while (score1 < 0 || score1 > 10);

    do {
        printf("Enter the second grade:\n");
        scanf("%f", &score2);
    } while (score2 < 0 || score2 > 10);

    do {
        printf("Finally, enter the third grade:\n");
        scanf("%f", &score3);
    } while (score3 < 0 || score3 > 10);

    do {
        printf("Which type of average would you like to calculate?\n");
        printf("A - Arithmetic Average\n");
        printf("P - Weighted Average\n");
        printf("H - Harmonic Average\n");
        scanf(" %c", &choice);
    } while ((choice != 'A') && (choice != 'a') &&
             (choice != 'P') && (choice != 'p') &&
             (choice != 'H') && (choice != 'h'));

    avg = calc_avg_gpa(score1, score2, score3, choice);

    printf("Your average is %.2f\n", avg);

    return 0;
}