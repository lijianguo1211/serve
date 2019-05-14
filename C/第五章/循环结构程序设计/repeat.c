#include <stdio.h>

int main()
{
    int n;
    for(n=100;n<=200;n++) {
        if (n % 3 == 0) continue;

        printf("%d",n);
    }

    printf("\n");


    return 0;
}

int main()
{
    int n;
    for(n=100;n<=200;n++) {
        if(n % 3 !== 0) printf("%d",n);
    }
}

int main()
{
    int i,j,n=0;

    for(i=1;i<=4;i++) {
        for(j=1;j<=5;j++) {
            if(n%5 == 0) printf("\n");

            printf("%d\t",i*j);
        }
    }

    printf("\n");

    return 0;
}