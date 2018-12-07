#include <unistd.h>
#include <string.h>
#include <stdio.h>
#include <stdlib.h>
#include <pthread.h>

typedef struct params{
	int N;
	int i;
	int tab[];
	int tailleTab;
}params;

void distribute2Ressources (int *tab, int N, int taulleTab){
	pthread_t t1, t2;
	pthread_create(&t1, NULL, affichage, );
}

void affichage(void* arg){

}

void main(){
	
}