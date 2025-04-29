@extends('layouts.template')
@section('content')
<div class="col-lg-10 ps-lg-0">


    <!-- Content Container -->
    <div class="content-container">
        <!-- Tabs Navigation -->
        <div class="tabs">
            <div class="tab active">Upload Files</div>
            <div class="tab">Recent Files</div>
            <div class="tab">Shared Files</div>
            <div class="tab">All Files</div>
        </div>

        <!-- Upload Area -->
        <div class="upload-area" id="uploadArea">
            <div class="upload-icon">
                <i class="fas fa-cloud-upload-alt"></i>
            </div>
            <h3 class="upload-text">Drag & Drop files here or click to browse</h3>
            <div class="mt-3">
                <button class="btn btn-primary">
                    <i class="fas fa-upload me-2"></i> Choose Files
                </button>
                <input type="file" id="fileInput" class="d-none" multiple>
            </div>
        </div>

        <!-- Files Section -->
        <div class="files-header">
            <h2 class="section-title">Recent Files</h2>
            <div class="view-toggle">
                <button class="toggle-btn active"><i class="fas fa-th"></i></button>
                <button class="toggle-btn"><i class="fas fa-list"></i></button>
            </div>
        </div>

        <div class="files-grid">
            <div class="file-card">
                <div class="file-actions">
                    <div class="action-btn"><i class="fas fa-download"></i></div>
                    <div class="action-btn"><i class="fas fa-share-alt"></i></div>
                    <div class="action-btn"><i class="fas fa-ellipsis-v"></i></div>
                </div>
                <div class="file-icon">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <div class="file-name">Project_Proposal.pdf</div>
                <div class="file-info">
                    <span>2.4 MB</span>
                    <span>Apr 9</span>
                </div>
            </div>

            <div class="file-card">
                <div class="file-actions">
                    <div class="action-btn"><i class="fas fa-download"></i></div>
                    <div class="action-btn"><i class="fas fa-share-alt"></i></div>
                    <div class="action-btn"><i class="fas fa-ellipsis-v"></i></div>
                </div>
                <div class="file-icon image">
                    <i class="fas fa-file-image"></i>
                </div>
                <div class="file-name">Team_Photo.jpg</div>
                <div class="file-info">
                    <span>3.8 MB</span>
                    <span>Apr 7</span>
                </div>
            </div>

            <div class="file-card">
                <div class="file-actions">
                    <div class="action-btn"><i class="fas fa-download"></i></div>
                    <div class="action-btn"><i class="fas fa-share-alt"></i></div>
                    <div class="action-btn"><i class="fas fa-ellipsis-v"></i></div>
                </div>
                <div class="file-icon document">
                    <i class="fas fa-file-word"></i>
                </div>
                <div class="file-name">Meeting_Notes.docx</div>
                <div class="file-info">
                    <span>512 KB</span>
                    <span>Apr 5</span>
                </div>
            </div>

            <div class="file-card">
                <div class="file-actions">
                    <div class="action-btn"><i class="fas fa-download"></i></div>
                    <div class="action-btn"><i class="fas fa-share-alt"></i></div>
                    <div class="action-btn"><i class="fas fa-ellipsis-v"></i></div>
                </div>
                <div class="file-icon excel">
                    <i class="fas fa-file-excel"></i>
                </div>
                <div class="file-name">Budget_2025.xlsx</div>
                <div class="file-info">
                    <span>1.2 MB</span>
                    <span>Apr 3</span>
                </div>
            </div>

            <div class="file-card">
                <div class="file-actions">
                    <div class="action-btn"><i class="fas fa-download"></i></div>
                    <div class="action-btn"><i class="fas fa-share-alt"></i></div>
                    <div class="action-btn"><i class="fas fa-ellipsis-v"></i></div>
                </div>
                <div class="file-icon video">
                    <i class="fas fa-file-video"></i>
                </div>
                <div class="file-name">Product_Demo.mp4</div>
                <div class="file-info">
                    <span>24.5 MB</span>
                    <span>Apr 1</span>
                </div>
            </div>

            <div class="file-card">
                <div class="file-actions">
                    <div class="action-btn"><i class="fas fa-download"></i></div>
                    <div class="action-btn"><i class="fas fa-share-alt"></i></div>
                    <div class="action-btn"><i class="fas fa-ellipsis-v"></i></div>
                </div>
                <div class="file-icon code">
                    <i class="fas fa-file-code"></i>
                </div>
                <div class="file-name">main.js</div>
                <div class="file-info">
                    <span>56 KB</span>
                    <span>Mar 29</span>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="activity-section">
            <div class="activity-header">
                <h2 class="section-title">Recent Activity</h2>
                <button class="btn btn-outline-primary btn-sm">View All</button>
            </div>

            <ul class="activity-list">
                <li class="activity-item">
                    <div class="activity-icon upload">
                        <i class="fas fa-upload"></i>
                    </div>
                    <div class="activity-details">
                        <div class="activity-text">You <strong>uploaded</strong> Project_Proposal.pdf</div>
                        <div class="activity-time">Today, 10:42 AM</div>
                    </div>
                </li>

                <li class="activity-item">
                    <div class="activity-icon share">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <div class="activity-details">
                        <div class="activity-text">You <strong>shared</strong> Budget_2025.xlsx with Sara Johnson</div>
                        <div class="activity-time">Yesterday, 4:23 PM</div>
                    </div>
                </li>

                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="activity-details">
                        <div class="activity-text">Mike Chen <strong>viewed</strong> Meeting_Notes.docx</div>
                        <div class="activity-time">Yesterday, 2:15 PM</div>
                    </div>
                </li>

                <li class="activity-item">
                    <div class="activity-icon upload">
                        <i class="fas fa-upload"></i>
                    </div>
                    <div class="activity-details">
                        <div class="activity-text">You <strong>uploaded</strong> 3 files to Product Design</div>
                        <div class="activity-time">Apr 8, 11:03 AM</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
@push('styles')
    <style>

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

.upload-area:hover {
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
}

    </style>
@endpush
