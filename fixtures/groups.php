<?php

namespace DataFixtures;

$groups = array(
    /**
     * For purposes
     */
    'core'          => 'Serves as the core foundation on which other tables depend.',
    'meta'          => 'Stores essential metadata or information about the database structure that is crucial for other tables.',
    'history'       => 'Store historical versions or snapshots of data to track changes over time.
                        Can be useful for auditing purposes or enabling the ability to roll back to previous states.',
    'temporary'     => 'Used to store temporary data that is generated during the execution of specific operations or processes.
                        Used to optimize performance or store intermediate results.',
    'cache'         => 'Used to store cached data that is utilized during the execution of specific operations or processes.
                        Used to optimize performance or store intermediate results.',

    /**
     * For connections
     */
    'undependant'   => 'Has no foreigh key.',
    'detached'      => 'Not in any relationship.',
    'm2m'           => 'Serves as intermediary for other tables.',
    'z-index0'      => 'Base tables other tables in database depend on.',
    'z-index999'    => 'Most tied tables in database.',
    'z-index1'      => 'Slightly tied tables which have dependencies from tables with lower z-index
                        (only zero in this case)).',
    'z-index2'      => '',
    'z-index3'      => '',

    /**
     * For subject area (domain)
     */


    /**
     * For migration stage(see https://github.com/IlyaSubtilnyj/MusicalInstrumentsOnlineService commit history for detail)
    */
    'wave-1'    => 'Created or modified in first migration(wave)',
    
);

return [
    TagFixtures::class => 
        [
            'core',
            'undependant',
            'z-index0',
            'wave-1'
        ],
];