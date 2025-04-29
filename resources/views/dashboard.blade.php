@extends('layouts.template')
@section('content')
<div class="col-lg-10 ps-lg-0">

    <!-- Content Container -->
    <div class="content-container">
        <!-- Tabs Navigation -->
        <div class="tabs">
            <a href="{{ route('dashboard') }}" class="tab {{ !isset($activeTab) || $activeTab == 'upload' ? 'active' : '' }}">Upload Files</a>
            <a href="{{ route('dashboard.recent') }}" class="tab {{ isset($activeTab) && $activeTab == 'recent' ? 'active' : '' }}">Recent Files</a>
            <a href="{{ route('dashboard.shared') }}" class="tab {{ isset($activeTab) && $activeTab == 'shared' ? 'active' : '' }}">Shared Files</a>
            <a href="{{ route('dashboard.all') }}" class="tab {{ isset($activeTab) && $activeTab == 'all' ? 'active' : '' }}">All Files</a>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(!isset($activeTab) || $activeTab == 'upload')
        <!-- Upload Area -->
        <form action="{{ route('dashboard.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <div class="upload-area" id="uploadArea" onclick="document.getElementById('fileInput').click();">
                <div class="upload-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <h3 class="upload-text">Drag & Drop files here or click to browse</h3>
                <div class="mt-3">
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('fileInput').click();">
                        <i class="fas fa-upload me-2"></i> Choose Files
                    </button>
                    <input type="file" id="fileInput" name="files[]" class="d-none" multiple onchange="document.getElementById('uploadForm').submit();">
                </div>
            </div>
        </form>
        @endif

        <!-- Files Section -->
        <div class="files-header">
            <h2 class="section-title">
                @if(isset($activeTab) && $activeTab == 'shared')
                    Shared With Me
                @elseif(isset($activeTab) && $activeTab == 'all')
                    All Files
                @else
                    Recent Files
                @endif
            </h2>
            <div class="view-toggle">
                <button class="toggle-btn active" id="gridView"><i class="fas fa-th"></i></button>
                <button class="toggle-btn" id="listView"><i class="fas fa-list"></i></button>
            </div>
        </div>

        <div class="files-grid">
            @if(isset($activeTab) && $activeTab == 'shared')
                @forelse($sharedFiles as $file)
                    <div class="file-card">
                        <div class="file-actions">
                            <a href="{{ route('dashboard.download', $file->id) }}" class="action-btn"><i class="fas fa-download"></i></a>
                            @if($file->pivot->access_level == 'edit' || $file->pivot->access_level == 'full')
                            <a href="#" class="action-btn" data-bs-toggle="modal" data-bs-target="#shareFileModal" data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}"><i class="fas fa-share-alt"></i></a>
                            @endif
                            <div class="action-btn" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard.download', $file->id) }}">Download</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#fileDetailsModal" data-file-id="{{ $file->id }}">Details</a></li>
                            </ul>
                        </div>
                        <div class="file-icon {{ $file->icon_class }}">
                            <i class="{{ $file->file_icon }}"></i>
                        </div>
                        <div class="file-name">{{ $file->name }}</div>
                        <div class="file-info">
                            <span>{{ $file->formatted_size }}</span>
                            <span>{{ $file->created_at->format('M d') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">No shared files found.</div>
                    </div>
                @endforelse
            @elseif(isset($activeTab) && $activeTab == 'all')
                @forelse($allFiles as $file)
                    <div class="file-card">
                        <div class="file-actions">
                            <a href="{{ route('dashboard.download', $file->id) }}" class="action-btn"><i class="fas fa-download"></i></a>
                            <a href="#" class="action-btn" data-bs-toggle="modal" data-bs-target="#shareFileModal" data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}"><i class="fas fa-share-alt"></i></a>
                            <div class="action-btn" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard.download', $file->id) }}">Download</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#shareFileModal" data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}">Share</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#fileDetailsModal" data-file-id="{{ $file->id }}">Details</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteFileModal" data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}">Delete</a></li>
                            </ul>
                        </div>
                        <div class="file-icon {{ $file->icon_class }}">
                            <i class="{{ $file->file_icon }}"></i>
                        </div>
                        <div class="file-name">{{ $file->name }}</div>
                        <div class="file-info">
                            <span>{{ $file->formatted_size }}</span>
                            <span>{{ $file->created_at->format('M d') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">No files found. Upload a file to get started.</div>
                    </div>
                @endforelse
            @else
                @forelse($recentFiles as $file)
                    <div class="file-card">
                        <div class="file-actions">
                            <a href="{{ route('dashboard.download', $file->id) }}" class="action-btn"><i class="fas fa-download"></i></a>
                            <a href="#" class="action-btn" data-bs-toggle="modal" data-bs-target="#shareFileModal" data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}"><i class="fas fa-share-alt"></i></a>
                            <div class="action-btn" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard.download', $file->id) }}">Download</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#shareFileModal" data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}">Share</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#fileDetailsModal" data-file-id="{{ $file->id }}">Details</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteFileModal" data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}">Delete</a></li>
                            </ul>
                        </div>
                        <div class="file-icon {{ $file->icon_class }}">
                            <i class="{{ $file->file_icon }}"></i>
                        </div>
                        <div class="file-name">{{ $file->name }}</div>
                        <div class="file-info">
                            <span>{{ $file->formatted_size }}</span>
                            <span>{{ $file->created_at->format('M d') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">No recent files found. Upload a file to get started.</div>
                    </div>
                @endforelse
            @endif
        </div>

        <!-- Recent Activity -->
        <div class="activity-section">
            <div class="activity-header">
                <h2 class="section-title">Recent Activity</h2>
                <a href="#" class="btn btn-outline-primary btn-sm">View All</a>
            </div>

            <ul class="activity-list">
                @forelse($recentActivities as $activity)
                    <li class="activity-item">
                        <div class="activity-icon {{ $activity->icon_class }}">
                            {!! $activity->activity_icon !!}
                        </div>
                        <div class="activity-details">
                            <div class="activity-text">
                                @if($activity->user_id == Auth::id())
                                    You <strong>{{ $activity->action }}ed</strong> {{ $activity->file->name }}
                                @else
                                    {{ $activity->user->name }} <strong>{{ $activity->action }}ed</strong> {{ $activity->file->name }}
                                @endif
                                @if($activity->details)
                                    {{ $activity->details }}
                                @endif
                            </div>
                            <div class="activity-time">
                                {{ $activity->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="activity-item">
                        <div class="activity-details">
                            <div class="activity-text">No recent activity.</div>
                        </div>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<!-- Share File Modal -->
<div class="modal fade" id="shareFileModal" tabindex="-1" aria-labelledby="shareFileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareFileModalLabel">Share File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- <form action="{{ route('dashboard.share') }}" method="POST" id="shareFileForm"> --}}
            <form action="" method="POST" id="shareFileForm">
                @csrf
                <input type="hidden" name="file_id" id="shareFileId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">User Email</label>
                        <input type="email" class="form-control" id="userEmail" name="user_email" required>
                        <div class="form-text">Enter the email of the user you want to share with.</div>
                    </div>
                    <div class="mb-3">
                        <label for="accessLevel" class="form-label">Access Level</label>
                        <select class="form-select" id="accessLevel" name="access_level" required>
                            <option value="view">View only</option>
                            <option value="edit">Edit</option>
                            <option value="full">Full access</option>
                        </select>
                    </div>
                    <div class="file-name-display mb-3">
                        <span class="text-muted">File: </span>
                        <span id="shareFileName"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Share</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- File Details Modal -->
<div class="modal fade" id="fileDetailsModal" tabindex="-1" aria-labelledby="fileDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileDetailsModalLabel">File Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4" id="fileDetailIcon">
                    <!-- Icon will be dynamically inserted here -->
                </div>

                <div class="file-details-content">
                    <div class="row mb-2">
                        <div class="col-4 text-muted">Name:</div>
                        <div class="col-8" id="fileDetailName"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted">Type:</div>
                        <div class="col-8" id="fileDetailType"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted">Size:</div>
                        <div class="col-8" id="fileDetailSize"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted">Uploaded:</div>
                        <div class="col-8" id="fileDetailDate"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted">Owner:</div>
                        <div class="col-8" id="fileDetailOwner"></div>
                    </div>
                </div>

                <div class="shared-with-section mt-4" id="sharedWithSection">
                    <h6>Shared With</h6>
                    <ul class="list-group" id="sharedWithList">
                        <!-- List of shared users will be populated here -->
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" class="btn btn-primary" id="fileDetailDownload">Download</a>
            </div>
        </div>
    </div>
</div>

<!-- Delete File Modal -->
<div class="modal fade" id="deleteFileModal" tabindex="-1" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteFileModalLabel">Delete File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="deleteFileName"></strong>? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                {{-- <form action="{{ route('dashboard.delete') }}" method="POST" id="deleteFileForm"> --}}
                <form action="" method="POST" id="deleteFileForm">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="file_id" id="deleteFileId">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Upload area drag and drop functionality
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('fileInput');

        if (uploadArea) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                uploadArea.classList.add('active');
            }

            function unhighlight() {
                uploadArea.classList.remove('active');
            }

            uploadArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;
                document.getElementById('uploadForm').submit();
            }
        }

        // Share file modal
        const shareFileModal = document.getElementById('shareFileModal');
        if (shareFileModal) {
            shareFileModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const fileId = button.getAttribute('data-file-id');
                const fileName = button.getAttribute('data-file-name');

                document.getElementById('shareFileId').value = fileId;
                document.getElementById('shareFileName').textContent = fileName;
            });
        }

        // File details modal
        const fileDetailsModal = document.getElementById('fileDetailsModal');
        if (fileDetailsModal) {
            fileDetailsModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const fileId = button.getAttribute('data-file-id');

                // Fetch file details via AJAX
                fetch(`/dashboard/file/${fileId}/details`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('fileDetailIcon').innerHTML = `<i class="${data.file_icon} fa-4x"></i>`;
                        document.getElementById('fileDetailName').textContent = data.name;
                        document.getElementById('fileDetailType').textContent = data.type.toUpperCase();
                        document.getElementById('fileDetailSize').textContent = data.formatted_size;
                        document.getElementById('fileDetailDate').textContent = data.created_at;
                        document.getElementById('fileDetailOwner').textContent = data.owner;
                        document.getElementById('fileDetailDownload').href = `/dashboard/file/${data.id}/download`;

                        // Handle shared users list
                        const sharedWithList = document.getElementById('sharedWithList');
                        sharedWithList.innerHTML = '';

                        if (data.shared_users && data.shared_users.length > 0) {
                            document.getElementById('sharedWithSection').style.display = 'block';
                            data.shared_users.forEach(user => {
                                const li = document.createElement('li');
                                li.className = 'list-group-item d-flex justify-content-between align-items-center';
                                li.innerHTML = `
                                    <div>
                                        <strong>${user.name}</strong>
                                        <small class="text-muted d-block">${user.email}</small>
                                    </div>
                                    <span class="badge bg-primary">${user.access_level}</span>
                                `;
                                sharedWithList.appendChild(li);
                            });
                        } else {
                            document.getElementById('sharedWithSection').style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching file details:', error);
                    });
            });
        }

        // Delete file modal
        const deleteFileModal = document.getElementById('deleteFileModal');
        if (deleteFileModal) {
            deleteFileModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const fileId = button.getAttribute('data-file-id');
                const fileName = button.getAttribute('data-file-name');

                document.getElementById('deleteFileId').value = fileId;
                document.getElementById('deleteFileName').textContent = fileName;
            });
        }

        // View toggle functionality
        const gridViewBtn = document.getElementById('gridView');
        const listViewBtn = document.getElementById('listView');
        const filesContainer = document.querySelector('.files-grid');

        if (gridViewBtn && listViewBtn) {
            gridViewBtn.addEventListener('click', function() {
                filesContainer.classList.remove('list-view');
                filesContainer.classList.add('grid-view');
                gridViewBtn.classList.add('active');
                listViewBtn.classList.remove('active');
                localStorage.setItem('fileViewMode', 'grid');
            });

            listViewBtn.addEventListener('click', function() {
                filesContainer.classList.remove('grid-view');
                filesContainer.classList.add('list-view');
                listViewBtn.classList.add('active');
                gridViewBtn.classList.remove('active');
                localStorage.setItem('fileViewMode', 'list');
            });

            // Load saved view preference
            const savedViewMode = localStorage.getItem('fileViewMode');
            if (savedViewMode === 'list') {
                listViewBtn.click();
            } else {
                gridViewBtn.click();
            }
        }
    });
</script>
@endpush

@push('styles')
<style>
/* Existing styles from the original template */
.content-container {
    padding: 1.5rem;
}

.tabs {
    display: flex;
    margin-bottom: 1.5rem;
    border-bottom: 1px solid #e3e6f0;
}

.tab {
    padding: 0.75rem 1.5rem;
    cursor: pointer;
    border-bottom: 3px solid transparent;
    transition: all 0.2s;
    font-weight: 600;
    text-decoration: none;
    color: inherit;
}

.tab:hover {
    color: var(--accent-color);
}

.tab.active {
    color: var(--primary-color);
    border-bottom-color: var(--primary-color);
}

.upload-area {
    border: 2px dashed #d1d3e2;
    border-radius: 0.5rem;
    padding: 2.5rem;
    text-align: center;
    background-color: var(--secondary-color);
    transition: all 0.3s;
    cursor: pointer;
    margin-bottom: 2rem;
}

.upload-area:hover, .upload-area.active {
    border-color: var(--primary-color);
    background-color: rgba(78, 115, 223, 0.05);
}

.upload-icon {
    font-size: 3rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.upload-text {
    font-size: 1.25rem;
    color: #6e707e;
    margin-bottom: 1rem;
}

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background-color: var(--accent-color);
    border-color: var(--accent-color);
}

.files-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #5a5c69;
    margin-bottom: 0;
}

.view-toggle {
    display: flex;
    gap: 0.5rem;
}

.toggle-btn {
    border: 1px solid #d1d3e2;
    background-color: white;
    border-radius: 0.25rem;
    padding: 0.375rem 0.75rem;
    cursor: pointer;
    transition: all 0.2s;
}

.toggle-btn.active {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.files-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

/* List view styles */
.files-grid.list-view {
    display: block;
}

.files-grid.list-view .file-card {
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
    padding: 0.75rem 1rem;
}

.files-grid.list-view .file-icon {
    font-size: 1.5rem;
    margin-bottom: 0;
    margin-right: 1rem;
    flex-shrink: 0;
}

.files-grid.list-view .file-name {
    flex: 1;
    margin-bottom: 0;
    -webkit-line-clamp: 1;
}

.files-grid.list-view .file-info {
    width: 200px;
    justify-content: flex-end;
    margin-left: 1rem;
}

.files-grid.list-view .file-actions {
    position: static;
    opacity: 1;
    margin-left: 1rem;
}

/* Normal card view styles */
.file-card {
    border-radius: 0.5rem;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
    background-color: white;
    padding: 1.5rem;
    transition: all 0.3s;
    position: relative;
    overflow: hidden;
}

.file-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.15);
}

.file-card:hover .file-actions {
    top: 1rem;
    opacity: 1;
}

.file-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    color: var(--primary-color);
    text-align: center;
}

.file-icon.image { color: var(--success-color); }
.file-icon.document { color: var(--info-color); }
.file-icon.excel { color: var(--success-color); }
.file-icon.video { color: var(--danger-color); }
.file-icon.code { color: var(--warning-color); }

.file-name {
    font-weight: 600;
    margin-bottom: 0.5rem;
    word-break: break-all;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.file-info {
    display: flex;
    justify-content: space-between;
    color: #858796;
    font-size: 0.85rem;
}

.file-actions {
    position: absolute;
    top: -2rem;
    right: 1rem;
    opacity: 0;
    transition: all 0.3s;
    display: flex;
    gap: 0.5rem;
}

.action-btn {
    width: 2rem;
    height: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background-color: white;
    color: #5a5c69;
    border: 1px solid #e3e6f0;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.action-btn:hover {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.activity-section {
    background-color: white;
    border-radius: 0.5rem;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
    padding: 1.5rem;
}

.activity-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.activity-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid #e3e6f0;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #f8f9fc;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    color: var(--primary-color);
}

.activity-icon.upload { color: var(--success-color); }
.activity-icon.share { color: var(--info-color); }
.activity-icon.download { color: var(--warning-color); }
.activity-icon.delete { color: var(--danger-color); }

.activity-details {
    flex: 1;
}

.activity-text {
    margin-bottom: 0.25rem;
}

.activity-time {
    font-size: 0.85rem;
    color: #858796;
}

/* File Details Modal */
#fileDetailIcon {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .files-grid {
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    }
}

@media (max-width: 768px) {
    .user-profile span {
        display: none;
    }

    .tabs {
        flex-wrap: wrap;
    }

    .tab {
        flex: 1;
        text-align: center;
        padding: 0.5rem;
    }

    .upload-area {
        padding: 1.5rem;
    }

    .upload-icon {
        font-size: 2rem;
    }

    .upload-text {
        font-size: 1rem;
    }

    .files-grid.list-view .file-info {
        display: none;
    }
}
</style>
@endpush
