<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			<li class="">
				<a href="{{ route('admin.index') }}">
					<i class="far fa-circle"></i>
					<span>Dashboard</span>
				</a>
			</li>

			@can('News-Admin')
			<li class="" id="adminNews">
				<a href="{{ route('admin.news.index') }}">
					<i class="far fa-newspaper"></i>
					<span>News</span>
				</a>
			</li>
			@endcan
			@can('Articel-Admin')
			<li class="" id="adminArticel">
				<a href="{{ route('admin.articel.index') }}">
					<i class="fa fa-paper-plane"></i>
					<span>Articel</span>
				</a>
			</li>
			@endcan
			@can('Active-Events')
			<li class="treeview" id="activeEvents">
				<a href="#">
					<i class="fa  fa-flash"></i>
					<span>Active Events</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					@isset ($activeEvents)
					@forelse ($activeEvents as $activeEvent)
					<li class="treeview">
						<a href="#">
							<i class=""></i>
							<span>{{ $activeEvent->name }}</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="#"><i class=""></i>Index</a></li>
							<li><a href="{{ route('activeEvents.seatplan',$activeEvent->id) }}"><i class=""></i>Sitzplan</a></li>
							<li><a href="{{ route('activeEvents.tournament', $activeEvent->id) }}"><i class=""></i>Turniere</a></li>
							<li><a href="{{ route('activeEvents.users',$activeEvent->id) }}"><i class="fa fa-users"></i>Teilnehmer</a></li>
							<li><a href="{{ route('activeEvents.arrival.index',$activeEvent->id) }}"><i class="fa fa-users"></i>Arrival</a></li>
						</ul>

					</li>
					@endforeach
					@endisset
				</ul>
			</li>
			@endcan
			@can('User-Admin')
			<li class="treeview" id="adminUserControl">
				<a href="#">
					<i class="fa fa-users"></i>
					<span>User Control</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('users.index') }}"><i class="fa fa-reply"></i> Users</a></li>
					<li><a href="{{ route('roles.index') }}"><i class="fa fa-tags"></i> Roles</a></li>
				</ul>
			</li>
			@endcan
			@can('Forum-Admin')
			<li class="treeview" id="adminForumControl">
				<a href="#">
					<i class="fa fa-reply-all"></i>
					<span>Forum</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('admin.forum.index') }}"><i class="fa fa-user"></i> Forum</a></li>
				</ul>
			</li>
			@endcan
			@can('Event-Admin')
			<li class="treeview" id="adminEvent">
				<a href="#">
					<i class="fa fa-birthday-cake"></i>
					<span>Event</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">					
					<li><a href="{{ route('eventlocation.index') }}"><i class="fa fa-map"></i> Location</a></li>

					<li><a href="{{ route('admin.event.index') }}"><i class="fa fa-birthday-cake"></i> Event</a></li>
					<li><a href="{{ route('eventSeatplan.index') }}"><i class="fa  fa-cubes"></i> Sitzplan</a></li> 
					<li><a href="{{ route('eventuser.index') }}"><i class="fa fa-user"></i> Users</a></li> 

					<li><a href="{{ route('eventsponsoren.index') }}"><i class="far fa-life-ring "></i> Sponsoren</a></li> 
					{{-- <li><a href="{{ route('eventsponsoren.index') }}"><i class="fa fa-support"></i> Partner</a></li>  --}}
					<li><a href="{{ route('admin.eventTickets.index') }}"><i class="fas fa-ticket-alt"></i> Tickets</a></li> 
					<li><a href="{{ route('eventTournament.index') }}"><i class="fas fa-trophy "></i> Tournament</a></li> 
					<li><a href="{{ route('eventGames.index') }}"><i class="fa fa-gamepad"></i> Games</a></li> 


					{{-- 					<li><a href="{{ route('ticket.index') }}"><i class="fa  fa-ticket"></i> Ticket</a></li> --}}
				</ul>
			</li>
			@endcan
			@can('Issue-Admin')
			<li class="" id="adminForumControl">
				<a href="{{ route('issueList.index') }}">
					<i class="fa fa-exclamation"></i>
					<span>Issue List</span>
				</a>
			</li>
			@endcan
			@can('Partner-Admin')
			<li class="" id="adminForumControl">
				<a href="{{ route('partner.index') }}">
					<i class="fa fa-child"></i>
					<span>Partner</span>
				</a>
			</li>
			@endcan
{{-- 			@can('Tickets-Admin')
			<li class="" id="adminForumControl">
				<a href="#">
					<i class="fa fa-ticket"></i>
					<span>Tickets</span>
				</a>
			</li>
			@endcan --}}
			@can('Media-Admin')
			<li class="" id="adminForumControl">
				<a href="{{ route('media.index') }}">
					<i class="fa fa-camera"></i>
					<span>Media</span>
				</a>
			</li>
			@endcan
			@can('Team-Admin')
			<li class="" id="adminForumControl">
				<a href="{{ route('admin.team.index') }}">
					<i class="fa fa-users"></i>
					<span>Team</span>
				</a>
			</li>
			@endcan
			@can('Teamspeak-Admin')
			<li class="" id="adminForumControl">
				<a href="#">
					<i class="fa fa-volume-up"></i>
					<span>Teamspeak</span>
				</a>
			</li>
			@endcan
			@can('Settings-Admin')
			<li class="" id="adminForumControl">
				<a href="#">
					<i class="fa  fa-cog"></i>
					<span>Settings</span>
				</a>
			</li>
			@endcan
			@can('Esports-Admin')
			<li class="treeview" id="adminForumControl" >
				<a href="#">
					<i class="fa fa-soccer-ball-o"></i>
					<span>Esports</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
			</li>
			@endcan
			@can('Presse-Admin')
			<li class="treeview" id="adminForumControl">
				<a href="#">
					<i class="fa fa-paper-plane"></i>
					<span>Presse</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
			</li>
			@endcan
			@can('Verein-Admin')
			<li class="treeview" id="adminForumControl">
				<a href="#">
					<i class="fa fa-rocket"></i>
					<span>Verein</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
			</li>
			@endcan
			@can('Layout-Admin')
			<li class="treeview" id="layoutOptions">
				<a href="#">
					<i class="fa fa-files-o"></i>
					<span>Layout Options</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					{{-- Layout Menus --}}
					<li id="widgets">
						<a href="{{ route('admin.widgets') }}">
							<i class="fa fa-th"></i> <span>Widgets</span>
							<span class="pull-right-container">
								<small class="label pull-right bg-green">new</small>
							</span>
						</a>
					</li>
					<li class="treeview" id="charts">
						<a href="#">
							<i class="fa fa-pie-chart"></i>
							<span>Charts</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="{{ route('admin.chartsjs') }}"><i class="fa fa-circle-o"></i> ChartJS</a></li>
							<li><a href="{{ route('admin.chartsMorris') }}"><i class="fa fa-circle-o"></i> Morris</a></li>
							<li><a href="{{ route('admin.chartsFlot') }}"><i class="fa fa-circle-o"></i> Flot</a></li>
							<li><a href="{{ route('admin.chartsInline') }}"><i class="fa fa-circle-o"></i> Inline charts</a></li>
						</ul>
					</li>

					<li class="treeview" id="uielements">
						<a href="#">
							<i class="fa fa-laptop"></i>
							<span>UI Elements</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="{{ route('admin.elementsGeneral') }}"><i class="fa fa-circle-o"></i> General</a></li>
							<li><a href="{{ route('admin.elementsIcons') }}"><i class="fa fa-circle-o"></i> Icons</a></li>
							<li><a href="{{ route('admin.elementsButtons') }}"><i class="fa fa-circle-o"></i> Buttons</a></li>
							<li><a href="{{ route('admin.elementsSliders') }}"><i class="fa fa-circle-o"></i> Sliders</a></li>
							<li><a href="{{ route('admin.elementsTimeline') }}"><i class="fa fa-circle-o"></i> Timeline</a></li>
							<li><a href="{{ route('admin.elementsModals') }}"><i class="fa fa-circle-o"></i> Modals</a></li>
						</ul>
					</li>
					<li class="treeview" id="forms">
						<a href="#">
							<i class="fa fa-edit"></i> <span>Forms</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="{{ route('admin.formsGeneral') }}"><i class="fa fa-circle-o"></i> General Elements</a></li>
							<li><a href="{{ route('admin.formsAdvanced') }}"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
							<li><a href="{{ route('admin.formsEditors') }}"><i class="fa fa-circle-o"></i> Editors</a></li>
						</ul>
					</li>
					<li class="treeview" id="tables">
						<a href="#">
							<i class="fa fa-table"></i> <span>Tables</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li id="simpleTable"><a href="{{ route('admin.tablesSimple') }}"><i class="fa fa-circle-o"></i> Simple tables</a></li>
							<li><a href="{{ route('admin.tablesData') }}"><i class="fa fa-circle-o"></i> Data tables</a></li>
						</ul>
					</li>

				</ul>

				{{-- Layout Menus END --}}
			</li>
			@endcan
			@can('Calendar-Admin')
			<li>
				<a href="{{ route('admin.calendar') }}">
					<i class="fa fa-calendar"></i> <span>Calendar</span>
					<span class="pull-right-container">
						<small class="label pull-right bg-red">3</small>
						<small class="label pull-right bg-blue">17</small>
					</span>
				</a>
			</li>

			@endcan
			@can('Mailbox-Admin')
			<li>
				<a href="{{ route('admin.mailbox') }}">
					<i class="fa fa-envelope"></i> <span>Mailbox</span>
					<span class="pull-right-container">
						<small class="label pull-right bg-yellow">12</small>
						<small class="label pull-right bg-green">16</small>
						<small class="label pull-right bg-red">5</small>
					</span>
				</a>
			</li>
			@endcan
			<li>
				<a href="{{ route('admin.startUpNews.index') }}">
					<i class="fa"></i> <span>Start Up News</span>
				</a>
			</li>

			@can('Pages-Admin')
			<li class="treeview">
				<a href="#">
					<i class="fa fa-folder"></i> <span>Pages</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('admin.pages.city') }}"><i class="fa fa-circle-o"></i> City</a></li>

{{-- 					<li><a href="{{ route('admin.pagesProfile') }}"><i class="fa fa-circle-o"></i> Profile</a></li>
					<li><a href="{{ route('admin.pagesLogin') }}"><i class="fa fa-circle-o"></i> Login</a></li>
					<li><a href="{{ route('admin.pagesRegister') }}"><i class="fa fa-circle-o"></i> Register</a></li>
					<li><a href="{{ route('admin.pageslockscreen') }}"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
					<li><a href="{{ route('admin.pages404Error') }}"><i class="fa fa-circle-o"></i> 404 Error</a></li>
					<li><a href="{{ route('admin.pages500Error') }}"><i class="fa fa-circle-o"></i> 500 Error</a></li>
					<li><a href="{{ route('admin.pagesblank') }}"><i class="fa fa-circle-o"></i> Blank Page</a></li> --}}
				</ul>
			</li>
			@endcan
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>