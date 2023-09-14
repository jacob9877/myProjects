#include <stdlib.h>
#include <stdio.h>

void swap(int *a, int *b)
{
    int temp = *a;
    *a = *b;
    *b = temp;
}

void bubbleSort(int arr[], int n, int *count)
{
    *count = 0;
    int i, j;
    for (i = 0; i < n - 1; i++)
    {
        for (j = 0; j < n - i - 1; j++)
        {
            if (arr[j] > arr[j + 1])
            {
                swap(&arr[j], &arr[j + 1]);
                *(count)++;
            }
        }
    }
}

void printArray(int arr[], int size, int count)
{
    int i;
    for (i = 0; i < size; i++)
    {
        printf("%d ", arr[i]);
    }
    printf("\nThe number of swaps = %d\n", count);
}

int main()
{
    int arr[] = {97, 16, 45, 63, 13, 22, 7, 58, 72};
    int n = 9;
    int count;
    bubbleSort(arr, n, &count);
    printf("Sorted array: \n");
    printArray(arr, n, count);
    return 0;
}
