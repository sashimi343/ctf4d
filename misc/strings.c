#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main(int argc, char const* argv[]) {
    char *flag = "FLAG{$cmd_strings}";
    char buf[255];

    printf("Do you want to print FLAG? [y/n]: ");
    fgets(buf, sizeof(buf), stdin);

    if(buf[0] == 'y') {
        printf("%s\n", flag);
    }

    return 0;
}
