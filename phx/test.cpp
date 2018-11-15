
#include "test_func.h"

extern "C" {
    PHPCPP_EXPORT void *get_module() {
        static Php::Extension extension("test_laravel", "1.0");
        
        extension.add<test_1>("test_1");

        return extension;
    }
}
