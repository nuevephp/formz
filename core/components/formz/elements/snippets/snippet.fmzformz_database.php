<?php
/**
 * @package formz
 * @var fmzForms $fmz
 */

$vx = $modx->getService('venuesx', 'vxVenues', $modx->getOption('venuex.core_path', null, $modx->getOption('core_path') . 'components/venuex/') . 'model/venuex/', $scriptProperties);
if (!($vx instanceof vxVenues)) return '';

$venue = $vx->cache->venue;

// Setup default options
$redirectTo = $modx->getOption('redirectTo', $scriptProperties, $venue->id);

if (!$hook->hasErrors()) {
    $event_type = $hook->getValue('event_type');
    $event_type = isset($event_type[0]) ? $event_type[0] : $event_type;

    $delegates = $hook->getValue('delegates');
    $delegates = isset($delegates[0]) ? $delegates[0] : $delegates;

    $facilities = $modx->toJSON($hook->getValue('facility'));
    $comments = $hook->getValue('comments');
    $problems = $hook->getValue('problems');

    /* ratings settings */
    $r_venue = $this->getValue('rating_venue');
    $r_venue = isset($r_venue[0]) ? $r_venue[0] : $r_venue;

    $r_access = $this->getValue('rating_access');
    $r_access = isset($r_access[0]) ? $r_access[0] : $r_access;

    $r_facilities = $this->getValue('rating_facilities');
    $r_facilities = isset($r_facilities[0]) ? $r_facilities[0] : $r_facilities;

    $r_staff = $this->getValue('rating_staff');
    $r_staff = isset($r_staff[0]) ? $r_staff[0] : $r_staff;

    $r_flexibility = $this->getValue('rating_flexibility');
    $r_flexibility = isset($r_flexibility[0]) ? $r_flexibility[0] : $r_flexibility;

    $r_catering = $this->getValue('rating_catering');
    $r_catering = isset($r_catering[0]) ? $r_catering[0] : $r_catering;

    $r_operations = $this->getValue('rating_operations');
    $r_operations = isset($r_operations[0]) ? $r_operations[0] : $r_operations;

    $ratings_arr = array(
        'venue' => $r_venue,
        'access' => $r_access,
        'facilities' => $r_facilities,
        'staff' => $r_staff,
        'flexibility' => $r_flexibility,
        'catering' => $r_catering,
        'operations' => $r_operations,
    );
    $ratings = $modx->toJSON($ratings_arr);

    $comment = $modx->newObject('vxComment');
    $comment->set('venue', $venue->id);
    $comment->set('comments', $comments);
    $comment->set('problems', $problems);
    $comment->set('delegates', $delegates);
    $comment->set('event_type', $event_type);
    $comment->set('facilities', $facilities);
    $comment->set('ratings', $ratings);
    $comment->set('active', 1);

    $comment->set('createdby', $modx->user->get('id'));
    $comment->set('createdon', date('Y-m-d H:i:s', time()));

    $comment->save();

    // Redirect to the current url
    // TODO Change the way how URL's are generated
    $url = $modx->makeUrl($redirectTo) . '/' . $venue->alias;
    $modx->sendRedirect($url);
}
