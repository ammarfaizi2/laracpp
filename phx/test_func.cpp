
#include <string.h>
#include <stdlib.h>
#include "test_func.h"

Php::Value test_1(Php::Parameters &p) {
	std::string h = "Hello World\n";
	for (int i = 0; i < 10000; ++i)
	{
		Php::out << h;
	}
	return 0;
}
